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
        $suits = ['s', 'c', 'd', 'h'];
        $hand = explode(' ', $this->hand);
        $suit = substr($hand[0], -1);
        $sortedHand = $hand;
        $marker = 0;
        $isFlush = True;
        $isStraight = True;
        $hasA = False;
        $count = 0;
        $hasTwoMore = 0;

        // Validate and sort the hand!!
        // Check that there are 5 cards in the handle
        if (count($hand) !== 5) {
          return 'Try again, a hand should be 5 cards.';
        }

        // Check that each card is valid
        foreach ($hand as $card) {
          if (in_array(substr($card, 0, -1), $order) === False or in_array(substr($card, -1), $suits) === False) {
            return 'Try again, one or more cards are invalid.';
          }
        }

        // Match the order in $order
        foreach ($order as $value) {
          foreach ($hand as $card) {
            if (substr($card, 0, -1) === $value) {
              $sortedHand[$marker] = $card;
              $marker++;
            }
          }
        }

        //reset variables
        $hand = $sortedHand;
        var_dump($hand);

        // Check if it's a flush
        foreach ($hand as $card) {
          if (substr($card, -1) !== $suit) {
            $isFlush = False;
          }
        }

        // Check if it's a straight (assumes the cards are sorted)
        // First find the first card value in the list of values
        for ($i = 0; $i < 13; $i++) {
          if (substr($hand[0], 0, -1) === $order[$i]) {
            $marker = $i;
            break;
          }
        }
        // Then make sure they follow the order of the list of values
        if ($marker > 8) {
          $isStraight = False; // Don't bother looking if there aren't even 5 cards to look at
        } else {
          for ($i = 0; $i < 5; $i++) {
            if (substr($hand[$i], 0, -1) !== $order[$marker]) {
              $isStraight = False;
              break;
            }
            $marker++;
          }
        }


        // Find the max number of a kind (assumes the cards are sorted)
        foreach ($hand as $card) {
          if (substr($card, 0, -1) === substr($hand[0], 0, -1)) {
            $count++;
          }
        }

        // Check for a pair in remaining cards
        foreach ($hand as $card) {
          if (substr($card, 0, -1) === substr($hand[$count], 0, -1)) {
            $hasTwoMore++;
          }
        }

        // Determine which hand it is
        if ($isFlush and $isStraight and substr($hand[0], 0, -1) === 'A') {
          return 'Royal Flush';
        } elseif ($isFlush and $isStraight) {
          return 'Straight Flush';
        } elseif ($count === 4) {
          return 'Four of a Kind';
        } elseif ($count === 3 and $hasTwoMore === 2) {
          return 'Full House';
        } elseif ($isFlush) {
          return 'Flush';
        } elseif ($isStraight) {
          return 'Straight';
        } elseif ($count === 3) {
          return 'Three of a Kind';
        } elseif ($count === 2 and $hasTwoMore === 2) {
          return 'Two Pair';
        } elseif ($count === 2) {
          return 'One Pair';
        } else {
          return 'High Card';
        }
    }
}
