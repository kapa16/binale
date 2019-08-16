<?php

declare(strict_types=1);

namespace App\Model\Contractor\UseCase\Create;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Contracts\Translation\TranslatorInterface;

class Form extends AbstractType
{
    private $translator;

    public function __construct(TranslatorInterface $translator)
    {
        $this->translator = $translator;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('number', TextType::class, [
                'label'=> $this->translator->trans('contractorNumber', [], 'labels')
            ])
            ->add('nameOne', TextType::class, ['label'=> 'Name 1'])
            ->add('nameTwo', TextType::class, ['label'=> 'Name 2'])
            ->add('creditorNumber', TextType::class, [
                'label'=> $this->translator->trans('creditorNumber', [], 'labels')
            ])
            ->add('creditorName', TextType::class, [
                'label'=> $this->translator->trans('creditorName', [], 'labels')
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Command::class,
            'csrf_protection' => true,
            'csrf_field_name' => '_token',
            'csrf_token_id'   => 'contractor_item',

        ]);
    }

}