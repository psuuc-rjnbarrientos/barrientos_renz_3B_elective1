<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MyController extends Controller
{
    public function calculate($operator, $num1, $num2) //method para sa pagcalculate ng values na ilalagay dun sa URL
    {
        $num1 = (float) $num1; //convertion ng input sa URL para maging float imbis na string
        $num2 = (float) $num2;
        $result = 0; //binigyan lang ng default value yung result
        function getNumberColor($num) //method ulit para naman makuha yung kulay nung kung odd or even yung number na nilagay
        {
            if ($num % 2 == 0) { //checheck nya lang if yung result ng modulo is zero, meaning nya is even, kapag hindi naman, meaning odd yung number
                return 'blue';
            } else {
                return 'orange';
            }
        }

        function getResultColor($result) // same lang dun sa getNumberColor na method ito para lang dun sa result, yung una kasi para dun sa input na numbers
        {
            if ($result % 2 == 0) {
                return 'green';
            } else {
                return 'blue';
            }
        }

        switch ($operator) { //switch naman ginamit ko para sa pagcheck ng operator para mas maliit yung code
            case 'add':
                $result = $num1 + $num2;
                break;
            case 'subtract':
                $result = $num1 - $num2;
                break;
            case 'multiply':
                $result = $num1 * $num2;
                break;
            case 'divide':
                if ($num2 == 0) { //ito para lang macheck if zero yung second input if zero para kapag zero yung nilagay, lalabas yung error na cannot be divided by zero
                    return "Error: Cannot be divided by zero";
                }
                $result = $num1 / $num2;
                break;
            default:
                return ""; //ito naman yung default kapag mali yung nilagay na input pero since error 404 din lang naman magpapakita, useless din lang kapag mali yung nilagay dun sa URL
        }

        $num1Color = getNumberColor($num1); //ito inaassign lang yung mga values ng num1 at num2 gamit yung method na getNumberColor
        $num2Color = getNumberColor($num2);
        $resultColor = getResultColor($result); //same din dito pero para naman sa result

        //ito naman yung result na ipapakita nya, HTML na may styles para maipakita yung kulay and yung text format
        //dun sa may result, gumamit lang ng span para sa ibat ibang part nung result para mailagay ng maayos yung mga variable na kailangan para dun sa mga style nung text 
        return "
        <h2>BARRIENTOS, Renz Jordan N. BSIT - 3B</h2>
        <p>Value 1: <span style='color: $num1Color; font-weight: bold;'>$num1</span></p>
        <p>Value 2: <span style='color: $num2Color; font-weight: bold;'>$num2</span></p>
        <p>Operator: $operator</p>
        <b style='color: $resultColor'>Result (Displayed in: <span style='text-transform: uppercase'>$resultColor</span>): <span style='background-color: $resultColor; color:white;'>$result</span></b>
        ";
    }
}
