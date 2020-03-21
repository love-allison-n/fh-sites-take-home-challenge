<?php

namespace PokerHand;

class PokerHand
{

    public function __construct($hand)
    {
      $this->hand = $hand;
    }

    public function getRank()
    {
        // TODO: Implement poker hand ranking

        $order = ['A', 'K', 'Q', 'J', '10', '9', '8', '7', '6', '5', '4', '3', '2'];
        $hand = explode(' ', $this->hand);
        $suit = substr($hand[0], -1);
        $firstCard = substr($hand[0], 0, -1);
        $marker = 0;
        $isFlush = True;
        $isStraight = True;
        $hasA = False;
        $count = 0;
        $hasTwoMore = 0;

        // Check if it's a flush
        foreach ($hand as $card) {
          if (substr($card, -1) !== $suit) {
            $isFlush = False;
          }
        }

        // Check if it's a straight (assumes the cards are sorted)
        // First find the first card value in the list of values
        for ($i = 0; $i < 13; $i++) {
          if ($firstCard == $order[$i]) {
            $marker = $i;
            break;
          }
        }
        // Then make sure they follow the order of the list of values
          for ($i = 0; $i < 5; $i++) {
            if (substr($hand[$i], 0, -1) !== $order[$marker]) {
              $isStraight = False;
              break;
            }
            $marker++;
          }


        // Find the max number of a kind (assumes the cards are sorted)
        foreach ($hand as $card) {
          if (substr($card, 0, -1) == $firstCard) {
            $count++;
          }
        }

        // Check for a pair in remaining cards
        foreach ($hand as $card) {
          if (substr($card, 0, -1) == substr($hand[$count], 0, -1)) {
            $hasTwoMore++;
          }
        }

        // Determine which hand it is
        if ($isFlush and $isStraight and $firstCard == 'A') {
          return 'Royal Flush';
        } elseif ($isFlush and $isStraight) {
          return 'Straight Flush';
        } elseif ($count == 4) {
          return 'Four of a Kind';
        } elseif ($count == 3 and $hasTwoMore == 2) {
          return 'Full House';
        } elseif ($isFlush) {
          return 'Flush';
        } elseif ($isStraight) {
          return 'Straight';
        } elseif ($count == 3) {
          return 'Three of a Kind';
        } elseif ($count == 2 and $hasTwoMore == 2) {
          return 'Two Pair';
        } elseif ($count == 2) {
          return 'One Pair';
        } else {
          return 'High Card';
        }
    }
}
