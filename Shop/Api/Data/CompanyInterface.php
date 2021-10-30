<?php

namespace TimKi\Shop\Api\Data;

use Magento\Tests\NamingConvention\true\string;

/**
 * Interface CompanyInterface
 * @package AlexPoletaev\Api\Data
 * @api
 */
interface CompanyInterface
{
    /**#@+
     * Constants
     * @var string
     */
    const ID = 'entity_id';
    const DESCRIPTION = 'description';
    const TITLE = 'title';
    /**#@-*/

    /**
     * @return int
     */
    public function getId();

    /**
     * @param int $id
     * @return $this
     */
    public function setId($id);

    /**
     * @return int
     */
    public function getDescription();

    /**
     * @param string $description
     * @return $this
     */
    public function setDescription(string $description);

    /**
     * @return string
     */
    public function getTitle();

    /**
     * @param string $title
     * @return $this
     */
    public function setTitle(string $title);

}
