<?php
/**
 * User: idulevich
 */

namespace TestTaskBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use TestTaskBundle\Entity\Account;
use TestTaskBundle\Entity\User;
use TestTaskBundle\Form\AccountEditFormType;
use TestTaskBundle\Form\UserEditFormType;

/**
 * Class TestTaskController
 * @package TestTaskBundle\Controller
 */
class TestTaskController extends Controller
{
    /**
     * @param Request $request
     * @return Response
     */
    public function indexAction(Request $request)
    {
        $userForm = $this->createForm(UserEditFormType::class, null);

        return $this->render('@TestTask/users.html.twig', [
            'user_form' => $userForm->createView(),
        ]);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function addUserAction(Request $request)
    {
        $entityManager = $this->getDoctrine()->getEntityManager();

        $user = new User();
        $userForm = $this->createForm(UserEditFormType::class, $user);

        $userForm->handleRequest($request);

        if ($userForm->isValid()) {
            $entityManager->persist($user);
            $entityManager->flush($user);
            return new JsonResponse([
                'status' => 'done'
            ]);
        }

        return new JsonResponse([
            'status' => 'error'
        ]);
    }

    /**
     * @param Request $request
     * @param int $userId
     * @return JsonResponse
     */
    public function delUserAction(Request $request, $userId)
    {
        $entityManager = $this->getDoctrine()->getEntityManager();

        $user = $entityManager->getRepository('TestTaskBundle:User')->find($userId);

        if (!empty($user)) {
            $entityManager->remove($user);
            $entityManager->flush();
            return new JsonResponse([
                'status' => 'done'
            ]);
        }

        return new JsonResponse([
            'status' => 'error'
        ]);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function getUsersAction(Request $request)
    {
        $usersRepository = $this->getDoctrine()->getRepository('TestTaskBundle:User');

        return new JsonResponse([
            'status' => 'done',
            'html' => $this->renderView('@TestTask/users.list.html.twig', [
                'users_list' => $usersRepository->getUsers(),
            ])
        ]);
    }


    /**
     * @param Request $request
     * @param int $userId
     * @return Response|\Symfony\Component\HttpKernel\Exception\NotFoundHttpException
     */
    public function accountsAction(Request $request, $userId)
    {
        $user = $this->getDoctrine()->getRepository('TestTaskBundle:User')->find($userId);

        if (empty($user)) {
            return $this->createNotFoundException('User not found!');
        }

        $accountForm = $this->createForm(AccountEditFormType::class, null);

        return $this->render('@TestTask/accounts.html.twig', [
            'user' => $user,
            'account_form' => $accountForm->createView(),
        ]);
    }

    /**
     * @param Request $request
     * @param int $userId
     * @return JsonResponse
     */
    public function addAccountAction(Request $request, $userId)
    {
        $entityManager = $this->getDoctrine()->getEntityManager();

        $user = $entityManager->getRepository('TestTaskBundle:User')->find($userId);
        if (empty($user)) {
            return new JsonResponse([
                'status' => 'error'
            ]);
        }

        $account = new Account();
        $account->setUser($user);
        $accountForm = $this->createForm(AccountEditFormType::class, $account);

        $accountForm->handleRequest($request);

        if ($accountForm->isValid()) {
            $entityManager->persist($account);
            $entityManager->flush($account);
            return new JsonResponse([
                'status' => 'done'
            ]);
        }

        return new JsonResponse([
            'status' => 'error'
        ]);
    }

    /**
     * @param Request $request
     * @param int $accountId
     * @return JsonResponse
     */
    public function delAccountAction(Request $request, $accountId)
    {
        $entityManager = $this->getDoctrine()->getEntityManager();

        $account = $entityManager->getRepository('TestTaskBundle:Account')->find($accountId);

        if (!empty($account)) {
            $entityManager->remove($account);
            $entityManager->flush();
            return new JsonResponse([
                'status' => 'done'
            ]);
        }

        return new JsonResponse([
            'status' => 'error'
        ]);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function getAccountsAction(Request $request, $userId)
    {
        $usersRepository = $this->getDoctrine()->getRepository('TestTaskBundle:User');

        $user = $usersRepository->find($userId);
        if (empty($user)) {
            return new JsonResponse([
                'status' => 'error'
            ]);
        }

        $accountsRepository = $this->getDoctrine()->getRepository('TestTaskBundle:Account');

        return new JsonResponse([
            'status' => 'done',
            'html' => $this->renderView('@TestTask/accounts.list.html.twig', [
                'accounts_list' => $accountsRepository->getAccountsByUser($user),
            ])
        ]);
    }
}