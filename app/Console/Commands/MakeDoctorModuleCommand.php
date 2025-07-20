<?php


namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Str;
use Illuminate\Filesystem\Filesystem;

class MakeDoctorModuleCommand extends Command
{
    protected $signature = 'make:doctor-module {name}';
    protected $description = 'Generate Doctor API module (Controller, Service, Repository, Interfaces, Request, and Bindings)';

    protected $filesystem;

    public function __construct()
    {
        parent::__construct();
        $this->filesystem = new Filesystem;
    }

    public function handle()
    {
        $name = Str::studly($this->argument('name'));

        $this->makeModel($name);
        $this->makeMigration($name);
        $this->makeController($name);
        $this->makeInterfaces($name);
        $this->makeRepository($name);
        $this->makeService($name);
        $this->makeRequest($name);
        $this->bindInProvider($name);

        $this->info("Doctor module for $name generated successfully.");
    }

    protected function makeController($name)
    {

        $path = app_path("Http/Controllers/Api/Doctor/{$name}/{$name}Controller.php");

        if (!$this->filesystem->exists(dirname($path))) {
            $this->filesystem->makeDirectory(dirname($path), 0755, true);
        }

        $stub = "<?php\n\nnamespace App\\Http\\Controllers\\Api\\Doctor\\{$name};\n\nuse App\\Http\\Controllers\\Controller;\n\nclass {$name}Controller extends Controller\n{\n    //\n}\n";

        $this->filesystem->put($path, $stub);
    }

    protected function makeInterfaces($name)
    {
        $serviceInterfacePath = app_path("Interfaces/Doctor/Services/{$name}/{$name}ServiceInterface.php");
        $repositoryInterfacePath = app_path("Interfaces/Doctor/Repositories/{$name}/{$name}RepositoryInterface.php");

        foreach ([$serviceInterfacePath, $repositoryInterfacePath] as $path) {
            if (!$this->filesystem->exists(dirname($path))) {
                $this->filesystem->makeDirectory(dirname($path), 0755, true);
            }
        }

        $this->filesystem->put($serviceInterfacePath, "<?php\n\nnamespace App\\Interfaces\\Doctor\\Services\\{$name};\n\ninterface {$name}ServiceInterface\n{\n    //\n}\n");

        $this->filesystem->put($repositoryInterfacePath, "<?php\n\nnamespace App\\Interfaces\\Doctor\\Repositories\\{$name};\n\ninterface {$name}RepositoryInterface\n{\n    //\n}\n");
    }

    protected function makeRepository($name)
    {
        $path = app_path("Repositories/Doctor/{$name}/{$name}Repository.php");
        $interface = "App\\Interfaces\\Doctor\\Repositories\\{$name}\\{$name}RepositoryInterface";

        if (!$this->filesystem->exists(dirname($path))) {
            $this->filesystem->makeDirectory(dirname($path), 0755, true);
        }

        $content = "<?php\n\nnamespace App\\Repositories\\Doctor\\{$name};\n\nuse {$interface};\n\nclass {$name}Repository implements {$name}RepositoryInterface\n{\n    //\n}\n";

        $this->filesystem->put($path, $content);
    }

    protected function makeService($name)
    {
        $path = app_path("Services/Doctor/{$name}/{$name}Service.php");
        $interface = "App\\Interfaces\\Doctor\\Services\\{$name}\\{$name}ServiceInterface";

        if (!$this->filesystem->exists(dirname($path))) {
            $this->filesystem->makeDirectory(dirname($path), 0755, true);
        }

        $content = "<?php\n\nnamespace App\\Services\\Doctor\\{$name};\n\nuse {$interface};\n\nclass {$name}Service implements {$name}ServiceInterface\n{\n    //\n}\n";

        $this->filesystem->put($path, $content);
    }

    protected function makeRequest($name)
    {
        $path = app_path("Http/Requests/Doctor/{$name}/{$name}Request.php");

        if (!$this->filesystem->exists(dirname($path))) {
            $this->filesystem->makeDirectory(dirname($path), 0755, true);
        }

        $stub = "<?php\n\nnamespace App\\Http\\Requests\\Doctor\\{$name};\n\nuse Illuminate\\Foundation\\Http\\FormRequest;\n\nclass {$name}Request extends FormRequest\n{\n    public function authorize(): bool\n    {\n        return true;\n    }\n\n    public function rules(): array\n    {\n        return [\n            //\n        ];\n    }\n}\n";

        $this->filesystem->put($path, $stub);
    }

    protected function bindInProvider($name)
    {
        $providerPath = app_path('Providers/RepositoryServiceProvider.php');

        if (!$this->filesystem->exists($providerPath)) {
            $this->filesystem->put($providerPath, "<?php\n\nnamespace App\\Providers;\n\nuse Illuminate\\Support\\ServiceProvider;\n\nclass RepositoryServiceProvider extends ServiceProvider\n{\n    public function register(): void\n    {\n        // bindings here\n    }\n}\n");
        }

        $content = $this->filesystem->get($providerPath);

        $bindingLine = "        \$this->app->bind(\\App\\Interfaces\\Doctor\\Repositories\\{$name}\\{$name}RepositoryInterface::class, \\App\\Repositories\\Doctor\\{$name}\\{$name}Repository::class);\n";
        $bindingLine .= "        \$this->app->bind(\\App\\Interfaces\\Doctor\\Services\\{$name}\\{$name}ServiceInterface::class, \\App\\Services\\Doctor\\{$name}\\{$name}Service::class);\n";

        if (!str_contains($content, $bindingLine)) {
            $content = preg_replace(
                '/public function register\(\): void\n\s*\{/',
                "public function register(): void\n    {\n" . $bindingLine,
                $content
            );
            $this->filesystem->put($providerPath, $content);
        }
    }

    protected function makeModel($name)
    {
        $this->call('make:model', [
            'name' => "{$name}"
        ]);
    }
    protected function makeMigration($name)
{
    $tableName = Str::plural(Str::snake($name));
    $migrationName = "create_{$tableName}_table";

    $this->call('make:migration', [
        'name' => $migrationName,
        '--create' => $tableName,
    ]);
}
}
