<?php

namespace JamBundle\Admin;

use JamBundle\Entity\JamType;
use JamBundle\Entity\JamYear;
use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

/**
 * Class JamJarAdmin
 * @package JamBundle\Admin
 */
class JamJarAdmin extends Admin
{
    /**
     * @param FormMapper $form
     */
    protected function configureFormFields(FormMapper $form)
    {
        $form
            ->add('type', EntityType::class, [
                'class' => JamType::class,
                'choice_name' => 'type',
            ])
            ->add('year', EntityType::class, [
                'class' => JamYear::class,
                'choice_name' => 'year',
            ])
            ->add('comment', TextType::class, ['required' => false])
        ;

        if ($this->isCurrentRoute('create')) {
            $form->add('amount', IntegerType::class, [
                'required' => false,
                'mapped' => false,
                'data' => '1',
                'empty_data' => '1'
            ]);
        }
    }

    /**
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('type')
            ->add('year')
        ;
    }

    /**
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('type')
            ->addIdentifier('year')
            ->addIdentifier('comment')
        ;
    }

    /**
     * @param mixed $object
     */
    public function prePersist($object)
    {
        $count = $this->getForm()->get('amount')->getData();

        if ($count > 1) {
            $service = $this->getConfigurationPool()->getContainer()->get('jam.jar_service');
            $service->cloneJam($object, $count - 1);
        }
    }
}
