<?php
### error handler

public function onKernelException(ExceptionEvent $event): void
    {
        $exception = $event->getThrowable();
        $className = get_class($exception);
        $code = $exception->getCode();
        
        // Change HttpClient exceptions (error 0) in "503 Unavailable"
        if ($exception instanceof TransportExceptionInterface) {
            $exception = new $className(
                $exception->getMessage(),
                $code !== 0 ?: Response::HTTP_SERVICE_UNAVAILABLE,
                $exception->getPrevious()
            );
        }

        // Flatten exception to json
        $event->setResponse(new JsonResponse(
            $this->normalizer->normalize(FlattenException::create($exception, $exception->getCode())),
            $exception->getCode()
        ));
    }


