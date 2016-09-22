<?php
    
    //randomly chooses a card out of deck of 52
    //chooses random integer for the index which is the
    //value of the card
    //then chooses random indeger for the suit. To get the card value
    //multiply the suit value by 13 then add the index value
    //passes the users card deck in by reference in order to update which card
    //was selected
    function displayRandomCard(&$array){
        
        //deck of the cards from 1..52
        $deck = array();
        $suits = array("clubs", "diamonds", "spades", "hearts");
        
        for ($i = 1; $i <= 52;$i++){
            $deck[] = $i;
        }
        
        $randSuite = rand(0,3); //random suit integer
        $randIndex = rand(1,13); //random index integer(value)
        $randNumber = ($randSuite * 13) + $randIndex; //gets the card value in deck
        
        /*
        If the value selected at random is already in the users deck then it keeps
        selecting new cards intil it gets a card that isnt already in the deck
        */
        while (sequentialSearch($array,$randNumber)){
            $randSuite = rand(0,3);
            $randIndex = rand(1,13);
            $randNumber = ($randSuite * 13) + $randIndex;
        }
        
        //creates the image with the given card value
        echo "<img src='img/cards/cards/$suits[$randSuite]/" . $randIndex. ".png' />";
        
        //adds the card value to the users deck to update it
        $array[] = $randNumber;
    }
    
    //checks if a given element is already in an array of hands. If it is
    //it returns true else returns false
    function sequentialSearch($array,$element){
        for ($i = 0; $i < count($array);$i++){
            
            //if card is already in deck returns true
            if ($array[$i] == $element){
                return true;
            }
        }
        
        return false;
    }
    
    
    /*Takes in the value of a card in the users deck to determine the value of it corrsponding
    to the value in the 52 deck*/
    function getCardValue($card){
    
    if ($card % 13 == 11 || $card % 13 == 12){
        return 10;
    }
    else if ($card % 13 == 0 && $card != 0){
        return 10;
    }
    else{
        return $card % 13;
    }
    
    }
    
    //calculates the total card value of all the cards in a users deck
    function deckSum($array){
        
        if (count($array) < 1){
            return 0;
        }
        else{
            $sum = 0;
            
            for ($i = 0; $i < count($array);$i++){
                $sum += getCardValue($array[$i]);
            }
            
        return $sum;
        }
    }
    
?>

<!DOCTYPE html>
<html>
    <head>
        <title> </title>
        
        <style>
            #holder {
                margin:0 auto;
                background-color:green;
            }
            
            #holder img {
                margin: 0 auto;
            }
            
            #title {
                text-align:center;
                
            }
            
            #player1 {
                margin:0 auto;
            }
        </style>
    </head>
    <body>
        <?php
        
        //arrayas to hold cards for each player
        $deck = array();
        $benCards = array();
        $cruzCards = array();
        $misealCards = array();
        
        //creates array for the deck of cards
        for ($i = 0; $i < 52;$i++){
            $deck[] = $i;
        }
        ?>
        <div id="holder">
            <h1 id="title">SilverJack</h1>
            
        <div id="player1">  
        <?php
        //sets the picture for the users cards
        $benCards[0] = "ben.jpg";
        echo "<img src='img/$benCards[0]'/>";
        
        //passes users deck by reference into displayRandomCard to generate a random card
        //while the sum of the users deck is less than 42
        for ($i = 0; deckSum($benCards) < 42 ;$i++){
            echo deckSum($benCards);
            displayRandomCard($benCards);
        }
        ?>
        </div>
        
        
        
        </div>
        
        
        
        
    </body>
</html>