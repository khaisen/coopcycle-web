<?php

declare(strict_types=1);

namespace Application\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;
use Laravolt\Avatar\Avatar;
use Shahonseven\ColorHash;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerAwareTrait;

final class Version20210216120712 extends AbstractMigration implements ContainerAwareInterface
{
    use ContainerAwareTrait;

    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        $dir = $this->container->getParameter('avatar_dir');

        if (!file_exists($dir)) {
            return;
        }

        $dir = rtrim($dir, '/');
        $files = glob("{$dir}/*.png");

        $colorHash = new ColorHash();

        $avatar = new Avatar([
            'uppercase' => true,
        ]);

        foreach ($files as $filename) {

            $username = basename($filename, '.png');

            $avatar
                ->create($username)
                ->setBackground($colorHash->hex($username))
                ->save($filename);
        }
    }

    public function down(Schema $schema) : void
    {
    }
}
