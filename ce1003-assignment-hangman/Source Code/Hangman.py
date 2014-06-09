# CE1003 Assignment 2 / Hangman                                                                                                              #
# Edwin Candinegara / U1320135K / FE2                                                                                                        #
#                                                                                                                                            #
# Note : please use command line to run the program as there is a syntax that can be used in command line only                               #
#                                                                                                                                            #
# Steps :                                                                                                                                    #
# 1. User chooses level                                                                                                                      #
# 2. Computer will select a word based on the level input from the dictionary randomly                                                       #
# 3. Show the player what alphabets have been guessed correctly, missed words, etc.                                                          #
# 4. Ask player to give an alphabet to guess or write "Hint" to ask for a hint                                                               #
# 5. Check whether the guess is right or not or a hint                                                                                       #
# 6. Repeat #3, #4, and #5 until the player misses 6 times (if player misses 6 times -> go to #9 directly).                                  #
#    If the word is guessed correctly by the player before the miss is 6, break THIS loop and continue to #7.                                #
# 7. Go to the next level -> computer will select randomly from the dictionary again                                                         #
# 8. Go back to #3 again. If 4 questions has been answered correctly, continue to #9                                                         #
# 9. If the player loses, it shows a picture of dead man, tell the result (and the word with the meaning)                                    #
# 10. If the player wins/guesses all four words correctly, it shows the result (and the last guessed word with the meaning)                  #
# 11. Ask whether the player wants to play again                                                                                             #
# 12. If yes, repeat the steps above until the user does not want to play again                                                              #
#                                                                                                                                            #
##############################################################################################################################################

import random
import picture
import definition
import time
import os
import string

#os.system('CLS') -> to clear the screen in command line mode
#time.sleep('t') -> to pause the program for t seconds

#level input                                                                                                
def inp_check() :
    import os
    global word_dict
    
    print('You lose if you miss 6 times in 1 question. \nThe number of lives will be reset to 6 when it goes to the next question!\n')
    print('Level : Easy / Medium / Hard / Challenge')
    check = input('Please choose the level you want : ').lower()      
    print()

    #ask again if the level is not a valid level as given
    while not (check in word_dict) :
        os.system('CLS')
        
        print('Please choose a valid category!\n')
        print('Level : Easy / Medium / Hard / Challenge')
        check = input('Please choose the category you want : ').lower()  
        print()                                                                                 

    os.system('CLS')                                                                                              
    return check                                                             


#input guess
def inp_guess() :

    #a list of lower case alphabets and 'hint'
    check = list(string.ascii_lowercase) + ['hint']

    #take guess input and make it in lower case
    inp = input('Guess or write "Hint" to use a hint : ').lower()

    #ask again if inp is not an alphabet or not "hint"
    while ((len(inp) != 1 and inp != 'hint') or (inp not in check)) :
        os.system('CLS')
        print_status()
        
        print('Please enter a valid alphabet to guess or write "Hint"!')
        inp = input('Guess or write "Hint" to use a hint : ').lower()
    
    return inp


#choose a word from the dictionary randomly based on the level input
def cat_random(text,dictionary) :
    import random
    import definition
    
    global word_dict
    
    result = random.choice(dictionary[text])
    result_lowered = result.lower()
    result_length = len(result)

    #throw away the chosen word -> so that word will not be chosen for the next question
    word_dict[text].remove(result) 

    return result, result_lowered, result_length, definition.meaning(result)


#store the index of the correctly guessed alphabet inside the chosen word                                                                                          
def pos_look(position , counter , text) :
    for x in word_chosen_lowered :                                                        
            if x == text :                                                         
                position += [counter]                                                                                        
            counter += 1                                                                  
                                                                                          
    return position , counter


#change the underscore inside the what have been guessed list with the correctly guessed alphabet
def change_alphabet(param) :
    global word_guessed_list, word_chosen

    pos_list = []
    counter = 0
                    
    #getting the position of the alphabet in the chosen word
    pos_list , counter = pos_look(pos_list , counter , param)

    #changing the guessed list with the right guessed alphabet
    for pos in pos_list :
        word_guessed_list[pos * 2] = word_chosen[pos] 


#function to check the guess input
def guess_check() :
        import time
        global guess_lower , word_chosen_lowered , word_guessed_str , word_guessed_list , miss, wrong, guess_nospace, hint_no

        #hint means adding an alphabet which has not been guessed by the player
        if guess_lower == "hint" :
            if hint_no > 0 :
                dummy = word_chosen_lowered

                #delete alphabets in the chosen word which have been guessed correctly -> only alphabets which haven't been guessed remaining
                for x in guess_nospace.lower() : 
                    dummy = dummy.replace(x , '' , len(dummy))

                #select a random alphabet from the remaining unguessed alphabet
                hint = random.choice(list(dummy))

                #change the list of what have been guessed
                change_alphabet(hint)
                hint_no -= 1
                
            else :
                print("You don't have any remaining hint!")
                time.sleep(1.5)
            
        else :
            #if the guessed alphabet is right
            if (guess_lower in word_chosen_lowered) : 
                if (guess_lower in word_guessed_str.lower()) :
                    print('You have entered the alphabet before')
                    time.sleep(1)
                    
                else :
                    change_alphabet(guess_lower)

            else : 
                if (guess_lower in miss) : 
                    print('You have entered the alphabet before')
                    time.sleep(1)
                    
                else :
                    wrong += 1
                    miss += guess_lower + ','

            print()


#function to print the status
def print_status() :
    global word_guessed_str , miss , wrong, score

    print("Question {} of 4".format(question+1))
    print("Your score : {}\n".format(score))
    print('Word:', word_guessed_str)
    print('Misses: {}\n'.format(miss[0:-1]))
    print('Remaining hints:', hint_no)
    print('You still have {} lives'.format(6-wrong))

    picture.result(wrong)
    

#printing current question result before going to the next level
def next_level() :
    import os
    global word_guessed_str , word_chosen, wrong, meaning

    wrong = 0
    
    print('Word: {}\n'.format(word_guessed_str))
    print('Right! The word is {}.'.format(word_chosen))
    print('It means {}\n'.format(meaning))
    print('Press enter to continue to the next word..  ', end='')
    input()
    os.system('CLS')


#ask whether player wants to play again
def resume() :

    print()
    x = input('Do you want to play again? (Y / N) ').lower()
    while (x != 'y' and x != 'n') :
        print()
        print('Please enter Y or N only!')
        x = input('Do you want to play again? (Y / N) ').lower()

    return x
    
######################################################################################################################################################################

again = 'y'
picture.start()

#Loop if the player wants to play again
while again == 'y' :
    os.system('CLS')
    hint_no = 5
        
    #List of words
    word_dict = {'easy':['Snowflake','Tiny','Huge','Guilty','Elevator','Bridge','Flashlight','Thunder','Dictionary','Nervous'],\
                 'medium': ['Rhythm', 'Aardvark','Cauldron','Myth','Putter','Rattle','Teenager','Travelator','Advertisement','Journal'], \
                 'hard':['Ambidextrous', 'Institutionalization','Cartography','Minaciously','Ergonomic','Millenarianism','Substantial',\
                         'Texturally','Separatist','Yearnful'],\
                 'challenge':['Antidisestablishmentarianism','Supercalifragilisticexpialidocious','Hippopotomonstrosesquipedaliophobia',\
                              'Pneumonoultramicroscopicsilicovolcanoconiosis','ostentatiousness','Floccinaucinihilipilification','Accoutrements','Circumlocution',\
                              'Magnanimous','Osculator']}

    #ask and check input 
    cat = inp_check()
        
    #counter variables    
    wrong = question = score = 0
        
    #loop level here
    while question < 4 :
            
        #select a random word
        word_chosen, word_chosen_lowered, word_length, meaning = cat_random(cat,word_dict)

        #list of what has been guessed
        word_guessed_list = list('_ ' * word_length)
            
        miss = ''

        #guessing part
        while wrong < 6 :
            
            #to join the list into string type
            word_guessed_str = ''.join(word_guessed_list) 

            #check whether the guess list = the chosen word
            guess_nospace = word_guessed_str.replace(' ','',word_length)
            if (word_chosen == guess_nospace) :
                os.system('CLS')
                break
            
            print_status()

            #take guess input
            guess_lower = inp_guess()

            #check the input
            guess_check()

            os.system('CLS')   
        #guessing ends

        #update variables
        question += 1
        score += 25

        #lose
        if wrong == 6 :
            os.system('CLS')
            break
        
        #all questions have been answered
        elif question == 4 :
            os.system('CLS')
            break
        
        else :
            next_level()
            

    if wrong == 6 :
        picture.dead()
        print('You lose! The word is {}.'.format(word_chosen))
        print('It means', meaning)
        print()
        print('You answer {} questions and your score is {}'.format(question - 1 , score - 25))
        again = resume() #to play again

    elif wrong < 6 :
        picture.saved()
        print('You win! The word is {}.'.format(word_chosen))
        print('It means', meaning)
        print()
        print('You answer all question correctly!\nFinal score : {}'.format(score))
        again = resume() #to play again
         
    
