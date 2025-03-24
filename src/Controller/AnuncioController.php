<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Anuncio;
use App\Form\AnuncioFormType;

final class AnuncioController extends AbstractController
{
    #[Route('/', name: 'app_anuncio')]
    public function anunciosNonVendidos(EntityManagerInterface $entityManager): Response
    {
        $anuncio = $entityManager->getRepository(Anuncio::class)->findBy(['vendido' => false]);

        return $this->render('anuncio/index.html.twig', ['anuncios' => $anuncio,]);
    }

    #[Route('/anuncio/historial', name: 'historial_anuncio')]
    public function historialAnuncios(EntityManagerInterface $entityManager): Response
    {
        $anuncio = $entityManager->getRepository(Anuncio::class)->findAll();

        return $this->render('anuncio/historial.html.twig', ['anuncios' => $anuncio,]);
    }

    #[Route('/anuncio/crear', name: 'crear_anuncio', methods: ['GET', 'POST'])]
    public function crearAnuncio(Request $request, EntityManagerInterface $entityManager): Response
    {
        if ($request->isMethod('POST')) {
            $nomeAnuncio = $request->request->get('nomeAnuncio');
            $descricion = $request->request->get('descricion');
            $prezoInicial = $request->request->get('prezoInicial');
            $dataPublicacion = $request->request->get('dataPublicacion');

            if ($nomeAnuncio && $descricion && $prezoInicial && $dataPublicacion) {
                $anuncio = new Anuncio();
                $anuncio->setNomeAnuncio($nomeAnuncio);
                $anuncio->setDescricion($descricion);
                $anuncio->setPrezoInicial((float)$prezoInicial);
                $anuncio->setDataPublicacion(new \DateTime($dataPublicacion));
                $anuncio->setVendido(false); 

                $entityManager->persist($anuncio);
                $entityManager->flush();

                return $this->redirectToRoute('app_anuncio');
            }
        }

        return $this->render('anuncio/form.html.twig');
    }

    #[Route('/anuncio/detalle/{id}', name: 'detalle_anuncio')]
    public function detalleAnuncio(EntityManagerInterface $entityManager, Anuncio $anuncio): Response
    {
        return $this->render('anuncio/detalle.html.twig', ['anuncio' => $anuncio,]);
    }

    #[Route('/anuncio/vender/{id}', name: 'vender_anuncio', methods: ['POST', 'GET'])]
    public function venderAnuncio(Request $request, EntityManagerInterface $entityManager, Anuncio $anuncio): Response
    {
        $prezoFinal = $request->request->get('prezoFinal');
        $dataVenta = $request->request->get('dataVenta');

        if ($prezoFinal !== null && $dataVenta !== null) {
            $anuncio->setPrezoFinal($prezoFinal);
            $anuncio->setVendido(true);
            $anuncio->setDataVenta(new \DateTime($dataVenta));

            $entityManager->flush();

            return $this->redirectToRoute('app_anuncio');
            }

        return $this->render('anuncio/vender.html.twig', ['anuncio' => $anuncio]);
    }
}