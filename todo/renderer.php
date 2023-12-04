declare(strict_types=1);

namespace Devtools\Infrastructure\NelmioSwagger\Renderer;
use Nelmio\ApiDocBundle\Render\Html\AssetsMode;
use Nelmio\ApiDocBundle\Render\OpenApiRenderer;
use OpenApi\Annotations\OpenApi;
use Twig\Environment;

final class HtmlOpenApiRenderer implements OpenApiRenderer
{
public function __construct(
private readonly Environment $twig,
private readonly OpenApiRenderer $innerRenderer,
) {
}
public function getFormat(): string
{
return $this->innerRenderer->getFormat();
}
public function render(OpenApi $spec, array $options = []): string
{
$options += [
'assets_mode' => AssetsMode::CDN,
'swagger_ui_config' => [
'deepLinking' => true,
'showExtensions' => true,
'docExpansion' => 'list',
'displayRequestDuration' => true,
'defaultModelsExpandDepth' => 0,
],
];
return $this->twig->render(
'@Devtools/Swagger/index.html.twig',
[
'swagger_data' => ['spec' => json_decode($spec->toJson(), true)],
'assets_mode' => $options['assets_mode'],
'swagger_ui_config' => $options['swagger_ui_config'],
]
);
}
}
