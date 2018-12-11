# Doctrine-trait-transactional-helper
Transactional helper trait for Doctrine 

A helper trait for Doctrine.

The trait containes a single method "createTransaction" that takes an Entity manager as a paramater and returns an instance of 
TransactionalService.From there on call "loadService" and give it the service you wish wrapped, and execute it with the 
request as a paramater.

The transactional service will wrap the service and make use of Doctrines transactional method to automatically flush all 
changes or revert them if an exception is thrown from within Doctrine, making sure you are back at starting point and have no 
half-finished changes in your DB.

EXAMPLE:

```
class AuthController extends FOSRestController
{

    use Transactional;


	public function registerUser(NewUserRegistration $service, Request $request, EntityManagerInterface $em)
	{
				$response = $this->createTransaction($em)->loadService($service)
						->executeTransaction(new NewUserRegistrationRequest(
								$request->get('email'),
								$request->get('password')
							));
				return new JsonResponse($response, Response::HTTP_CREATED);
	}

}
```		
NOTICE.
The service being wrapped must implement the "TransactionalServiceInterface".

TransactionalService containes one more method "overrideDefaultSession" that can be called again after the service has been 
initialized to change the EntityManager passed in through the constructor. However the object passed in must implement 
TransactionalSession (Example of such object is in dir: Sessions)
