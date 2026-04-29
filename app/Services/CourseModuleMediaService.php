<?php

namespace App\Services;

use Illuminate\Support\Facades\File;
use Symfony\Component\Process\Process;

class CourseModuleMediaService
{
    /**
     * Export each slide as PNG using LibreOffice (headless). Returns public-relative paths sorted by slide order.
     *
     * @return array<int, string>|null
     */
    public function extractPptSlides(string $pptAbsolutePath, string $publicSlidesDirectoryRelative): ?array
    {
        $binary = $this->resolveLibreOfficeBinary();
        if ($binary === null || ! File::isFile($pptAbsolutePath)) {
            return null;
        }

        $tmpOut = storage_path('app/tmp/ppt-export-'.uniqid('', true));
        File::makeDirectory($tmpOut, 0755, true);

        try {
            $process = new Process([
                $binary,
                '--headless',
                '--invisible',
                '--nodefault',
                '--nolockcheck',
                '--nologo',
                '--norestore',
                '--convert-to',
                'png',
                '--outdir',
                $tmpOut,
                $pptAbsolutePath,
            ]);
            $process->setTimeout(360);
            $process->run();

            if (! $process->isSuccessful()) {
                return null;
            }

            $pngs = File::glob($tmpOut.'/*.png');
            if ($pngs === [] || $pngs === false) {
                $pngs = File::glob($tmpOut.'/*.PNG');
            }
            if ($pngs === [] || $pngs === false) {
                return null;
            }

            natcasesort($pngs);
            $pngs = array_values($pngs);

            $targetDir = public_path($publicSlidesDirectoryRelative);
            File::makeDirectory($targetDir, 0755, true);

            $relative = [];
            foreach ($pngs as $i => $abs) {
                $name = 'slide-'.str_pad((string) ($i + 1), 3, '0', STR_PAD_LEFT).'.png';
                File::move($abs, $targetDir.'/'.$name);
                $relative[] = rtrim($publicSlidesDirectoryRelative, '/').'/'.$name;
            }

            return $relative;
        } finally {
            File::deleteDirectory($tmpOut);
        }
    }

    private function resolveLibreOfficeBinary(): ?string
    {
        foreach (['/usr/bin/soffice', '/usr/bin/libreoffice', '/snap/bin/libreoffice'] as $path) {
            if (is_string($path) && is_executable($path)) {
                return $path;
            }
        }

        foreach (['soffice', 'libreoffice'] as $cmd) {
            $which = Process::fromShellCommandline('command -v '.escapeshellarg($cmd));
            $which->run();
            if ($which->isSuccessful()) {
                $found = trim($which->getOutput());
                if ($found !== '' && is_executable($found)) {
                    return $found;
                }
            }
        }

        return null;
    }
}
