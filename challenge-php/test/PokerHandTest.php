<?php
namespace PokerHand;

use PHPUnit\Framework\TestCase;

class PokerHandTest extends TestCase
{
    /**
     * @test
     */
    public function itCanRankARoyalFlush()
    {
        $hand = new PokerHand('As Ks Qs Js 10s');
        $this->assertEquals('Royal Flush', $hand->getRank());
    }


    /**
     * @test
     */
    public function itCanRankAPair()
    {
        $hand = new PokerHand('Ah As 10c 7d 6s');
        $this->assertEquals('One Pair', $hand->getRank());
    }

    /**
     * @test
     */
    public function itCanRankTwoPair()
    {
        $hand = new PokerHand('Kh Kc 3s 3h 2d');
        $this->assertEquals('Two Pair', $hand->getRank());
    }

    /**
     * @test
     */
    public function itCanRankAFlush()
    {
        $hand = new PokerHand('Kh Qh 6h 2h 9h');
        $this->assertEquals('Flush', $hand->getRank());
    }

    // TODO: More tests go here
    /**
     * @test
     */
    public function itCanRankAFullHouse()
    {
        $hand = new PokerHand('6d 8h 8c 6s 8d');
        $this->assertEquals('Full House', $hand->getRank());
    }

    /**
     * @test
     */
    public function itCanRankAStraightFlush()
    {
        $hand = new PokerHand('8d 7d 5d 4d 6d');
        $this->assertEquals('Straight Flush', $hand->getRank());
    }

    /**
     * @test
     */
    public function itCanRankAStraight()
    {
        $hand = new PokerHand('4d 8h 5d 7d 6c');
        $this->assertEquals('Straight', $hand->getRank());
    }

    /**
     * @test
     */
    public function itCanRankAFourOfAKind()
    {
        $hand = new PokerHand('Js 5c Jc Jd Jh');
        $this->assertEquals('Four of a Kind', $hand->getRank());
    }

    /**
     * @test
     */
    public function itCanRankAThreeOfAKind()
    {
        $hand = new PokerHand('2c 3d 2h 9c 2d');
        $this->assertEquals('Three of a Kind', $hand->getRank());
    }

    /**
     * @test
     */
    public function itCanRankAHighCard()
    {
        $hand = new PokerHand('Js As Qs 7d Ks');
        $this->assertEquals('High Card', $hand->getRank());
    }

    /**
     * @test
     */
    public function itCanRankInvalidHand()
    {
        $hand = new PokerHand('As Ks Qs Js');
        $this->assertEquals('Try again, a hand should be 5 cards.', $hand->getRank());
    }

    /**
     * @test
     */
    public function itCanRankInvalidCards()
    {
        $hand = new PokerHand('Ah 13s Qc Js 7d');
        $this->assertEquals('Try again, one or more cards are invalid.', $hand->getRank());
    }
}
