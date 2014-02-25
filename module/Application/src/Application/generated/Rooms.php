<?php



use Doctrine\ORM\Mapping as ORM;

/**
 * Rooms
 *
 * @ORM\Table(name="rooms")
 * @ORM\Entity
 */
class Rooms
{
    /**
     * @var integer
     *
     * @ORM\Column(name="roomId", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $roomid;

    /**
     * @var string
     *
     * @ORM\Column(name="roomName", type="string", length=45, nullable=true)
     */
    private $roomname;

    /**
     * @var integer
     *
     * @ORM\Column(name="roomQuota", type="integer", nullable=true)
     */
    private $roomquota;


}
