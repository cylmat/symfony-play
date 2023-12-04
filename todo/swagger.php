final class SwaggerFilteredRouteCollectionCompilerPass implements CompilerPassInterface
{
private const AREAS = ['default'];
public function process(ContainerBuilder $container): void
{
foreach (self::AREAS as $area) {
if (!$container->hasDefinition('nelmio_api_doc.routes.' . $area)) {
continue;
}
$definition = $container->findDefinition('nelmio_api_doc.routes.' . $area);
$this->processService($container, $definition, $area);
}
}
private function processService(ContainerBuilder $container, Definition $routeDefinition, string $area): void
{
$routesBuilderServiceName = 'nelmio_api_doc.routes_filter.' . $area;
$innerFactory = $routeDefinition->getFactory()[0] ?? null;
if ($innerFactory === null) {
return;
}
$routesBuilderDefinition = new Definition(FilteredRouteCollectionBuilder::class);
$routesBuilderDefinition->setArguments([
'$controllerReflector' => new Reference('nelmio_api_doc.controller_reflector'),
'$innerBuilder' => $innerFactory,
]);
$container->setDefinition($routesBuilderServiceName, $routesBuilderDefinition);
$routeDefinition->setFactory(new Reference($routesBuilderServiceName));
}
}
