<?php

namespace App\Http\Controllers;

use BotMan\BotMan\BotMan;
use Illuminate\Http\Request;
use BotMan\BotMan\Messages\Incoming\Answer;
use BotMan\BotMan\Messages\Outgoing\Actions\Button;
use BotMan\BotMan\Messages\Outgoing\Question;
use BotMan\BotMan\Messages\Conversations\Conversation;
use App\Models\Message; // Assuming Message model exists

class BotManController extends Controller
{
    public function handle()
    {
        $botman = app('botman');

        $botman->hears("{message}", function (BotMan $bot) {

            $question = Question::create("Ask a question?")
                ->addButtons([
                    Button::create("How do I make an appointment?")->value("appointment"),
                    Button::create("Can I walk in without an appointment?")->value("walk"),
                    Button::create("What are the clinic's hours of operation?")->value('operation'),
                    Button::create("Where is the student clinic located?")->value('located'),
                    Button::create("How can I contact the student clinic?")->value('contact'),
                    Button::create("How do I cancel or reschedule my appointment?")->value('cancelled'),
                    Button::create("What services does the clinic provide?")->value('provide'),
                    Button::create("Do I need to pay for services at the student clinic?")->value('pay'),
                    Button::create("How can I access my health records?")->value('records'),
                    Button::create("How's your day?")->value('day'),

                    //ask more question
                    Button::create("Ask more question?")->value('chatify'),
                ]);

            $bot->ask($question, function (Answer $answer, $botman) {
                // Detect if button was clicked:
                if ($answer->isInteractiveMessageReply()) {
                    if ($answer->getValue() == 'appointment') {
                        $botman->say('<a href="http://pup.localhost/userlogin" target="_blank" style="text-decoration:none"> ' . 'Appointments can be made online through our appointment system. 
                        Please log in to your account to check availability.' . '</a>');
                    } else if ($answer->getValue() == 'walk') {
                        $botman->say('Walk-ins are accepted, but appointments are recommended to ensure timely service.');
                    } else if ($answer->getValue() == 'operation') {
                        $botman->say('The clinic is open Monday to Friday from 8:00 AM to 5:00 PM.');
                    } else if ($answer->getValue() == 'located') {
                        $botman->say('The clinic is located at PUP Sta.Mesa.');
                    } else if ($answer->getValue() == 'contact') {
                        $botman->say('You can contact the clinic via phone at 09992295884 / 09992295886.');
                    } else if ($answer->getValue() == 'cancelled') {
                        $botman->say('You can cancel or reschedule your appointment online or by chat messages.');
                    } else if ($answer->getValue() == 'provide') {
                        $botman->say('The clinic provides general health consultations and more.');
                    } else if ($answer->getValue() == 'pay') {
                        $botman->say('Basic services are covered by the student health fee.');
                    } else if ($answer->getValue() == 'records') {
                        $botman->say('Health records can be accessed through the clinic`s patient portal or by requesting them at the clinic.');
                    } else if ($answer->getValue() == 'day') {
                        $botman->say('I am Fine');
                  
                  //Ask more question
                    } else if ($answer->getValue() == 'chatify') {
                        $botman->say('<a href="http://pup.localhost/userlogin" target="_blank">' .
                            'Click this link to sign in'
                            . '</a>');
                    }
                } else {
                    $botman->say('No category was selected');
                }

                // // Store bot's response

            });
        });

        $botman->listen();
    }





}

