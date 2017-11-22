<?php
/**
 * Created by PhpStorm.
 * User: cristian.salanta
 * Date: 15/11/2017
 * Time: 12:28
 */

namespace AppBundle\Controller;

use AppBundle\Entity\Location;
use AppBundle\Entity\Market;
use Guzzle\Http\Exception\CurlException;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Guzzle\Http\Client;
use Symfony\Component\HttpFoundation\Response;
use Guzzle\Http\Exception\ClientErrorResponseException;
use AppBundle\Exceptions\SalantasException;


class GuzzleController extends Controller
{
    public function createClientAction()
    {
        //$myClient = new Client('http://vrnap1.qa1.allegiantair.com');
        $myClient = new Client('http://www.allegiantair.com');
        try {
            $request = $myClient->get('/meta/resweb/Market/BLILAS.json');
            $response = $request->send();

            $random = 244;


            throw new SalantasException("Ana are mere",$random,$request,$response);

        }catch (ClientErrorResponseException $e) {
            return new Response("The url provided is broken. Ana are mere. Also: \n". $e->getMessage());
        }catch(CurlException $e){
            return new Response("Ala bala portocala \n". $e->getMessage());
        }
        catch(SalantasException $e){
            return new Response($e->errorMessage());
        }

        /** Prin faptu ca am specificat la "Market.php" si "Location.php" tipurile
         *  care sa fie oflosite de catre Serializer, s-a tras jsonu de pe site-ul respectiv si s-a
         *  deserializat intr-un obiect.
         */
        // You must send a request in order for the transfer to occur
        $response = $request->send();
        $data = $response->getBody();

        $serializer = $this->container->get('serializer');
        $flight = $serializer->deserialize($data, 'AppBundle\Entity\Market', 'json');


//        $flight = new Market();
//
//        $flight->setValidTo($data['valid_to']);
//        $flight->setFlightDays($data['flight_days']);
//        $flight->setValidFrom($data['valid_from']);
//        $flight->setName($data['name']);
//
//        $flight->setDescription($data['description'])->newProp;
//
//        $flight->setUri($data['uri']);
//
//            // aici trebuie sa bag in "to" si "from"
//            $toLocation = new Location();
//        $toLocation->setCountry($data['to']['country']);
//        $toLocation->setLat($data['to']['lat']);
//        $toLocation->setLocationId($data['to']['location_id']);
//        $toLocation->setDisplayName($data['to']['display_name']);
//        $toLocation->setState($data['to']['state']);
//        $toLocation->setCity($data['to']['city']);
//        $toLocation->setAirportCode($data['to']['airport_code']);
//        $toLocation->setLong($data['to']['long']);
//        $toLocation->setTimeZone($data['to']['time_zone']);
//        $toLocation->setTitle($data['to']['title']);
//            $flight->setTo($toLocation);
//            $fromLocation = new Location();
//        $fromLocation->setCountry($data['from']['country']);
//        $fromLocation->setLat($data['from']['lat']);
//        $fromLocation->setLocationId($data['from']['location_id']);
//        $fromLocation->setDisplayName($data['from']['display_name']);
//        $fromLocation->setState($data['from']['state']);
//        $fromLocation->setCity($data['from']['city']);
//        $fromLocation->setAirportCode($data['from']['airport_code']);
//        $fromLocation->setLong($data['from']['long']);
//        $fromLocation->setTimeZone($data['from']['time_zone']);
//        $fromLocation->setTitle($data['from']['title']);
//            $flight->setFrom($fromLocation);
//        $flight->setType($data['type']);
//        $flight->setId($data['id']);
//        $flight->setReswebid($data['reswebid']);

        $salam = new \Symfony\Component\HttpFoundation\Response();

        return $salam;
    }
}