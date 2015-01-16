<?php

namespace Matthias\User\Presentation\Infrastructure\WebBundle\Controller;

use Matthias\User\App\Command\RegisterUserCommand;
use Matthias\User\Presentation\Infrastructure\WebBundle\Form\RegisterUserType;
use Symfony\Component\DependencyInjection\ContainerAware;
use Symfony\Component\Form\Form;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;

class UserController extends ContainerAware
{
    private function createRegisterForm()
    {
        /** @var Form $registerUserForm */
        $registerUserForm = $this->container->get('form.factory')->create(new RegisterUserType(), null, array(
            'action'			=> $this->container->get('router')->generate('matthias_user_presentation_web_register'),
            'method' 			=> 'POST',
            'csrf_protection'	=> false,
        ));
        
        return $registerUserForm;
    }

    public function showRegistrationAction()
    {
        /** @var Form $registerUserForm */
        $registerUserForm = $this->createRegisterForm();

        return $this->container->get('templating')->renderResponse(
            'MatthiasUserPresentationInfrastructureWebBundle:User:show_registration.html.twig',
            array(
                'registration_form' => $registerUserForm->createView(),
            ));
    }

    public function registerAction(Request $request)
    {
        /** @var Form $registerUserForm */
        $registerUserForm = $this->createRegisterForm();

        $registerUserForm->handleRequest($request);

        if ($registerUserForm->isValid()) {

            // OK -> redirect to profile page

            /** @var RegisterUserCommand $command */
            $command = $registerUserForm->getData();

            $this->container->get('command_bus')->handle($command);

            $url = $this->container->get('router')->generate('matthias_user_presentation_web_show_profile');

            $response = new RedirectResponse($url);

        } else {

            $response = $this->container->get('templating')->renderResponse(
                'MatthiasUserPresentationInfrastructureWebBundle:User:show_registration.html.twig',
                array(
                    'registration_form' => $registerUserForm->createView(),
                ));
        }

        return $response;
    }

    public function showProfileAction()
    {
        // TODO: use service to get user data from database

        return $this->container->get('templating')->renderResponse(
            'MatthiasUserPresentationInfrastructureWebBundle:User:show_profile.html.twig',
            array(
                'user' => null,
            ));
    }
}
