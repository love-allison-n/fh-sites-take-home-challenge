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
        $hand = new PokerHand('8h 8d 8c 6d 6s');
        $this->assertEquals('Full House', $hand->getRank());
    }

    /**
     * @test
     */
    public function itCanRankAStraightFlush()
    {
        $hand = new PokerHand('8d 7d 6d 5d 4d');
        $this->assertEquals('Straight Flush', $hand->getRank());
    }

    /**
     * @test
     */
    public function itCanRankAStraight()
    {
        $hand = new PokerHand('8h 7d 6c 5d 4d');
        $this->assertEquals('Straight', $hand->getRank());
    }

    /**
     * @test
     */
    public function itCanRankAFourOfAKind()
    {
        $hand = new PokerHand('Js Jc Jd Jh 5c');
        $this->assertEquals('Four of a Kind', $hand->getRank());
    }

    /**
     * @test
     */
    public function itCanRankAThreeOfAKind()
    {
        $hand = new PokerHand('2c 2h 2d 3d 9c');
        $this->assertEquals('Three of a Kind', $hand->getRank());
    }

    /**
     * @test
     */
    public function itCanRankAHighCard()
    {
        $hand = new PokerHand('As Ks Qs Js 7d');
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
