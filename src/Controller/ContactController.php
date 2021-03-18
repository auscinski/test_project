<?php

namespace App\Controller;

use App\Form\ContactType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class ContactController extends AbstractController
{
    private HttpClientInterface $client;
    private $content;

    public function __construct(HttpClientInterface $client)
    {
        $this->client = $client;
    }

    /**
     * @Route("/contact", name="contact")
     * @param Request $request
     * @return Response
     */
    public function contact(Request $request): Response
    {
        $form = $this->createForm(ContactType::class);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){

            $contactFormData = $form->getData();

            $response = $this->client->request(
                'GET',
                'https://disposable.debounce.io/?email='.$contactFormData['email']
            );

//            $contentType = $response->getHeaders()['content-type'][0];
//            $content = $response->getContent();
            $this->content = $response->toArray();


        }

        if ($this->content['disposable'] === "false") {
            $form = false;
        } else {
            $form = $form->createView();
        }

        return $this->render('contact/form.html.twig', [
            'contact_form' => $form
        ]);


    }
}
