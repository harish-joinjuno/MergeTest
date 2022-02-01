<?php


namespace App\Traits;

use Illuminate\Support\Str;
use Symfony\Component\Finder\Finder;

trait NeedsFileNamesFromDirectory
{
    protected function getFilenamesFromResourcesDirectory($resourceDirectory)
    {
        $templatesDirectory        = resource_path($resourceDirectory);

        $array                     = [];

        $templateFiles = (new Finder)->files()->in($templatesDirectory);
        foreach ($templateFiles as $templateFile) {
            $fileName = explode('.', $templateFile->getFilename())[0];
            if (!Str::startsWith($fileName, '_')) {
                $templateName     = Str::title(str_replace('-', ' ', $fileName));
                $array[$fileName] = $templateName;
            }
        }

        return $array;
    }

    protected function getFilenamesFromAppDirectory($appDirectory)
    {
        $templatesDirectory   = app_path($appDirectory);

        $array                = [];
        $templateFiles        = (new Finder)->files()->in($templatesDirectory);
        foreach ($templateFiles as $templateFile) {
            $fileName         = explode('.', $templateFile->getFilename())[0];
            $baseName = '';
            if ($templateFile->getPathInfo()->getBasename() && $templateFile->getPathInfo()->getBasename() !== $appDirectory) {
                $baseName = $templateFile->getPathInfo()->getBasename() . '\\';
            }
            if (! Str::contains($fileName, 'Abstract')) {
                $key              = 'App\\' . $appDirectory . '\\' . $baseName . $fileName;
                $array[$key]      = preg_replace('/(?<!\ )[A-Z]/', ' $0', $fileName);
            }
        }

        return $array;
    }

    protected function getDirectoryNamesFromDirectory(string $templatesDirectory): array
    {
        $array                     = [];

        $templateDirectories = (new Finder)->directories()->depth(0)->in($templatesDirectory);
        foreach ($templateDirectories as $templateFile) {
            $fileName = explode('.', $templateFile->getFilename())[0];
            if (!Str::startsWith($fileName, '_')) {
                $templateName     = Str::title(str_replace('-', ' ', $fileName));
                $array[$fileName] = $templateName;
            }
        }

        return $array;
    }
}
