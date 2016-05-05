<?php

namespace JamBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;

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
            ->add('type', 'entity', [
                'class' => 'JamBundle\Entity\JamType',
                'choice_name' => 'type',
            ])
            ->add('year', 'entity', [
                'class' => 'JamBundle\Entity\JamYear',
                'choice_name' => 'year',
            ])
            ->add('comment', 'text', ['required' => false])
        ;

        if ($this->isCurrentRoute('create')) {
            $form->add('amount', 'integer', [
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
            $service->cloneJam($object, $count);
        }
    }
}
