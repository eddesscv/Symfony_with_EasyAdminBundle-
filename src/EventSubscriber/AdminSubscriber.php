<?php

namespace App\EventSubscriber;

use App\Entity\Category;
use App\Entity\Product;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use EasyCorp\Bundle\EasyAdminBundle\Event\BeforeEntityPersistedEvent;
use EasyCorp\Bundle\EasyAdminBundle\Event\BeforeEntityUpdatedEvent;

class AdminSubscriber implements EventSubscriberInterface
{
    public static function getSubscribedEvents()
    {
        return [
            BeforeEntityPersistedEvent::class => ['setCreatedAt'],
            BeforeEntityUpdatedEvent::class => ['setUpdatedAt'],
        ];
    }

    public function setCreatedAt(BeforeEntityPersistedEvent $event)
    {
        //dd($event);
        $entityInstance = $event->getEntityInstance();

        if (!$entityInstance instanceof Product && !$entityInstance instanceof Category) return;

        $entityInstance->setCreatedAt(new \DateTimeImmutable);
    }

    public function setUpdatedAt(BeforeEntityUpdatedEvent $event)
    {
        $entityInstance = $event->getEntityInstance();

        if (!$entityInstance instanceof Product && !$entityInstance instanceof Category) return;

        $entityInstance->setUpdatedAt(new \DateTimeImmutable);
    }
}
