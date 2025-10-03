
namespace Devtools\Infrastructure\Swagger\Routing;

use Nelmio\ApiDocBundle\Routing\FilteredRouteCollectionBuilder as NelmioFilteredRouteCollectionBuilder;
use Nelmio\ApiDocBundle\Util\ControllerReflector;
use OpenApi\Attributes as OA;
use Symfony\Component\Routing\Route;
use Symfony\Component\Routing\RouteCollection;

final class FilteredRouteCollectionBuilder
{
	public function __construct(
	private readonly ControllerReflector $controllerReflector,
	private readonly NelmioFilteredRouteCollectionBuilder $innerBuilder,
	) {}

	public function __invoke(RouteCollection $routes): RouteCollection
	{
		$nelmioFilteredRoutes = $this->innerBuilder->filter($routes);
		$filteredRoutes = new RouteCollection();
		foreach ($nelmioFilteredRoutes->all() as $name => $route) {
			if ($this->hasTag($route)) {
				$filteredRoutes->add($name, $route);
			}
		}
		return $filteredRoutes;
	}

	private function hasTag(Route $route): bool
	{
		$controller = $route->getDefault('_controller');
		$reflectionMethod = $this->controllerReflector->getReflectionMethod($controller);
		/** @var \ReflectionAttribute[] $allAnnotations */
		$allAnnotations = array_merge(
		$reflectionMethod?->getDeclaringClass()?->getAttributes() ?? [],
		$reflectionMethod?->getAttributes() ?? []
		);
		foreach ($allAnnotations as $annotation) {
			if (is_a($annotation->getName(), OA\Tag::class, true)) {
				return true;
			}
		}
		return false;
	}
}

