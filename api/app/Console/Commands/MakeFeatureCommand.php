<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Str;

class MakeFeatureCommand extends Command
{
  protected $signature = 'make:feature {name} {--full-feature}';
  protected $description = 'Create a feature with Admin, Public and shared structure';

  public function handle(Filesystem $files): int
  {
    $name = Str::studly($this->argument('name'));

    $basePath = app_path("Features/{$name}");
    $adminPath = "{$basePath}/Admin";

    $directories = [
      // Admin HTTP structure
      'Admin/Controllers',
      'Admin/Requests',
      'Admin/DTOs',
      'Admin/Queries',
      'Admin/Actions',
      'Admin/Resources',
      // Public starts empty
      'Public',
      // Shared feature code
      'Models',
    ];

    if ($this->option('full-feature')) {
      $directories = array_merge($directories, [
        'Services',
        'Events',
        'Listeners',
        'Exceptions',
        'Enums',
      ]);
    }

    foreach ($directories as $directory) {
      $files->ensureDirectoryExists(
        "{$basePath}/{$directory}"
      );
    }

    // Shared model
    $this->createFile(
      files: $files,
      stubName: 'model.stub',
      destination: "{$basePath}/Models/{$name}.php",
      feature: $name
    );

    // Admin CRUD files
    foreach (['Store', 'Update', 'Delete', 'Show', 'List'] as $operation) {
      $this->createAdminOperationFiles(
        files: $files,
        adminPath: $adminPath,
        feature: $name,
        operation: $operation
      );
    }

    $this->info("Feature {$name} created successfully.");

    return self::SUCCESS;
  }

  private function createAdminOperationFiles(Filesystem $files,string $adminPath,string $feature,string $operation): void {
    $filesToCreate = [
      "controller" => [
        'stub' => 'admin/controller.stub',
        'path' => "{$adminPath}/Controllers/{$operation}{$feature}Controller.php",
      ],
      "request" => [
        'stub' => 'admin/request.stub',
        'path' => "{$adminPath}/Requests/{$operation}{$feature}Request.php",
      ],
      "dto" => [
        'stub' => 'admin/dto.stub',
        'path' => "{$adminPath}/DTOs/{$operation}{$feature}DTO.php",
      ],
      "action" => [
        'stub' => 'admin/action.stub',
        'path' => "{$adminPath}/Actions/{$operation}{$feature}Action.php",
      ],
      "query" => [
        'stub' => 'admin/query.stub',
        'path' => "{$adminPath}/Queries/{$operation}{$feature}Query.php",
      ],
      "resource" => [
        'stub' => 'admin/resource.stub',
        'path' => "{$adminPath}/Resources/{$operation}{$feature}Resource.php",
      ],
    ];
    
    foreach ($filesToCreate as $key => $file ) {
      if ($operation === 'Delete' && in_array($key, ['dto', 'query', 'resource'], true)) {
        continue;
      }

      if ($operation === 'Store' && in_array($key, ['query','resource'], true)) {
        continue;
      }

      if ($operation === 'Update' && in_array($key, ['query', 'resource'], true)) {
        continue;
      }

      $this->createFile(
        files: $files,
        stubName: $file['stub'],
        destination: $file['path'],
        feature: $feature,
        operation: $operation
      );
    }
  }

  private function createFile(
    Filesystem $files,
    string $stubName,
    string $destination,
    string $feature,
    ?string $operation = null
  ): void {
    if ($files->exists($destination)) {
      $this->warn("Skipped existing file: {$destination}");

      return;
    }

    $stubPath = base_path("stubs/feature/{$stubName}");

    if (! $files->exists($stubPath)) {
      $this->error("Stub not found: {$stubPath}");

      return;
    }

    $stub = $files->get($stubPath);

    $stub = str_replace(
      ['{{ feature }}', '{{ operation }}'],
      [$feature, $operation ?? ''],
      $stub
    );

    $files->put($destination, $stub);
  }
}
