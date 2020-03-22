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
        $sortedHand = [];
        $marker = 0;
        $isFlush = True;
        $isStraight = True;
        $hasA = False;
        $count = 1;
        $hasPair = 0;

        // Validate and sort the hand!!
        // Check that there are 5 cards in the hand
        if (count($hand) !== 5) {
          return 'Try again, a hand should be 5 cards.';
        }

        // Check that each card is valid
        foreach ($hand as $card) {
          if (in_array(substr($card, 0, -1), $order) === False) {
            return 'Try again, one or more cards are invalid.';
          } elseif (in_array(substr($card, -1), $suits) === False) {
            return 'Try again, one or more cards are invalid.';
          }
        }

        // Sort to match the order of the list of values
        foreach ($order as $value) {
          foreach ($hand as $card) {
            if (substr($card, 0, -1) === $value) {
              $sortedHand[$marker] = $card;
              $marker++;
            }
          }
        }
        $hand = $sortedHand;


        // Check if it's a flush
        foreach ($hand as $card) {
          if (substr($card, -1) !== substr($hand[0], -1)) {
            $isFlush = False;
          }
        }

        // Check if it's a straight
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

        // Find and count the duplicates
        for ($i = 0; $i < 4; $i++) {
          if (substr($hand[$i], 0, -1) === substr($hand[$i+1], 0, -1)) {
            $count++;
          } elseif ($count === 2) {
              $hasPair++;
              $count = 1;
          } elseif ($count === 3) {
              if (substr($hand[$i+1], 0, -1) === substr($hand[$i+2], 0, -1)) {
                $hasPair++;
              }
              break;
          }
        }

        // Determine which hand it is
        if ($isFlush and $isStraight and substr($hand[0], 0, -1) === 'A') {
          return 'Royal Flush';
        } elseif ($isFlush and $isStraight) {
          return 'Straight Flush';
        } elseif ($count === 4) {
          return 'Four of a Kind';
        } elseif ($count === 3 and $hasPair === 1) {
          return 'Full House';
        } elseif ($isFlush) {
          return 'Flush';
        } elseif ($isStraight) {
          return 'Straight';
        } elseif ($count === 3) {
          return 'Three of a Kind';
        } elseif ($hasPair === 2) {
          return 'Two Pair';
        } elseif ($hasPair === 1) {
          return 'One Pair';
        } else {
          return 'High Card';
        }
    }
}
