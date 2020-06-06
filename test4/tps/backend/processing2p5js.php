<?php
ini_set('default_charset', 'utf-8'); 

function processing2p5js($containerName, $pde){
    $pWords = "/(catch|class|delay|draw|exit|extends|false|final|implements|import|loop|new|noLoop|null|popStyle|private|public|pushStyle|redraw|return|setup|size|static|super|this|true|try|void|cursor|focused|frameCount|frameRate|frameRate|height|noCursor|online|screen|width|boolean|byte|char|color|double|float|int|long|Array|ArrayList|HashMap|Object|String|XMLElement|binary|boolean|byte|char|float|hex|int|str|unbinary|unhex|join|match|matchAll|nf|nfc|nfp|nfs|split|splitTokens|trim|Array Functions|append|arrayCopy|concat|expand|reverse|shorten|sort|splice|subset|for|while|break|case|continue|default|else|if|switch|PShape|arc|ellipse|line|point|quad|rect|triangle|bezier|bezierDetail|bezierPoint|bezierTangent|curve|curveDetail|curvePoint|curveTangent|curveTightness|box|sphere|sphereDetail|ellipseMode|noSmooth|rectMode|smooth|strokeCap|strokeJoin|strokeWeight|beginShape|bezierVertex|curveVertex|endShape|texture|textureMode|vertex|loadShape|shape|shapeMode|mouseButton|mouseClicked|mouseDragged|mouseMoved|mousePressed|mousePressed|mouseReleased|mouseX|mouseY|pmouseX|pmouseY|key|keyCode|keyPressed|keyPressed|keyReleased|keyTyped|BufferedReader|createInput|createReader|loadBytes|loadStrings|open|selectFolder|selectInput|link|param|status|day|hour|millis|minute|month|second|year|print|println|save|saveFrame|PrintWriter|beginRaw|beginRecord|createOutput|createWriter|endRaw|endRecord|saveBytes|saveStream|saveStrings|selectOutput|applyMatrix|popMatrix|printMatrix|pushMatrix|resetMatrix|rotate|rotateX|rotateY|rotateZ|scale|shearX|shearY|translate|ambientLight|directionalLight|lightFalloff|lightSpecular|lights|noLights|normal|pointLight|spotLight|beginCamera|camera|endCamera|frustum|ortho|perspective|printCamera|printProjection|modelX|modelY|modelZ|screenX|screenY|screenZ|ambient|emissive|shininess|specular|background|colorMode|fill|noFill|noStroke|stroke|alpha|blendColor|blue|brightness|color|green|hue|lerpColor|red|saturation|PImage|createImage|image|imageMode|loadImage|noTint|requestImage|tint|blend|copy|filter|get|loadPixels|pixels[]|set|updatePixels|PGraphics|createGraphics|hint|PFont|createFont|loadFont|text|textFont|textAlign|textLeading|textMode|textSize|textWidth|textAscent|textDescent|PVector|abs|ceil|constrain|dist|exp|floor|lerp|log|mag|map|max|min|norm|pow|round|sq|sqrt|acos|asin|atan|atan2|cos|degrees|radians|sin|tan|noise|noiseDetail|noiseSeed|random|randomSeed|HALF_PI|PI|QUARTER_PI|TWO_PI)/";
    $pFunctions = "/((resizeCanvas|sin|cos|endShape|vertex|bezierDetail|pop|push|rotate|textAlign|bezier|translate|random|beginShape|textSize|quad|strokeCap|point|colorMode|smooth|rectMode|line|circle|ellipseMode|fill|ellipse|createCanvas|background|noFill|stroke|noStroke|triangle|strokeWeight|text|rect|arc|radians|loadImage|image|dist|loadFont|loadText|textFont|noCursor|cursor|loop|noLoop|map|noise)(\s){0,}\()/";
    $pVars = "/(frameCount|BOTTOM|CLOSE|SQUARE|CORNERS|CORNER|ROUND|mouseX|mouseY|CENTER|TWO_PI|HALF_PI|PIE|PI|QUARTER|RGB|width|height|HSB|LEFT_ARROW|RIGHT_ARROW|UP_ARROW|DOWN_ARROW|key|RIGHT|LEFT|TOP)/";
   
    $pde = str_replace("<br>", "", $pde);
    $pde = str_replace("<p>", "", $pde);
    $pde = str_replace("</p>", "\n", $pde);
    $pde = str_replace("&nbsp;", "", $pde);
    $pde = preg_replace("/\/\/.+\n/","", $pde);//Remove comments

    $pde = strip_tags($pde);
    
    $pde = str_replace("&lt;", "<", $pde);
    $pde = str_replace("&gt;", ">", $pde);
    
    $p5jsReturn = $pde;
    $p5jsReturn = preg_replace("/new float\[(\w+)]/","new Array($1)", $pde);
    $p5jsReturn = preg_replace("/new int\[(\w+)]/","new Array($1)", $p5jsReturn);
    $p5jsReturn = preg_replace("/new int \[(\w+)]/","new Array($1)", $p5jsReturn);
    $p5jsReturn = preg_replace("/new PImage\[(\w+)]/","new Array($1)", $p5jsReturn);
    $p5jsReturn = preg_replace("/new PImage \[(\w+)]/","new Array($1)", $p5jsReturn);
    $p5jsReturn = preg_replace("/new PFont\[(\w+)]/","new Array($1)", $p5jsReturn);
    $p5jsReturn = preg_replace("/new PFont \[(\w+)]/","new Array($1)", $p5jsReturn);
    $p5jsReturn = preg_replace("/new boolean\[(\w+)]/","new Array($1)", $p5jsReturn);
    $p5jsReturn = preg_replace("/new boolean \[(\w+)]/","new Array($1)", $p5jsReturn);
    $p5jsReturn = preg_replace("/new boolean \[(\w+)]/","new Array($1)", $p5jsReturn);
    $p5jsReturn = preg_replace("/new PVector\((\w+,.\w+)\)/","createVector($1)", $p5jsReturn);
    $p5jsReturn = preg_replace("/new PVector \((\w+,.\w+)\)/","createVector($1)", $p5jsReturn);
    $p5jsReturn = preg_replace("/\b(int|float|PImage|PFont|boolean)\s\[\]/","var ", $p5jsReturn);
    $p5jsReturn = preg_replace("/\b(color|int|float|boolean|String|Char|PImage|PFont|long|PVector)\s/","var ", $p5jsReturn);
    $p5jsReturn = preg_replace("/size/","createCanvas", $p5jsReturn);
    $p5jsReturn = preg_replace("/void/","function", $p5jsReturn);
    $p5jsReturn = preg_replace("/(push)Matrix|(pop)Matrix/","$1$2", $p5jsReturn);
    $p5jsReturn = preg_replace("/(push)Style|(pop)Style/","$1$2", $p5jsReturn);
    $p5jsReturn = preg_replace("/mousePressed/","mouseIsPressed", $p5jsReturn);
    $p5jsReturn = preg_replace("/frameRate/","frameRate()", $p5jsReturn);
    $p5jsReturn = preg_replace("/mouseIsPressed\(\)/","mousePressed()", $p5jsReturn);
    $p5jsReturn = preg_replace("/LEFT/","LEFT_ARROW", $p5jsReturn);
    $p5jsReturn = preg_replace("/RIGHT/","RIGHT_ARROW", $p5jsReturn);
    $p5jsReturn = preg_replace("/UP/","UP_ARROW", $p5jsReturn);
    $p5jsReturn = preg_replace("/DOWN/","DOWN_ARROW", $p5jsReturn);
    $p5jsReturn = preg_replace("/;/",";\n", $p5jsReturn);
    $p5jsReturn = preg_replace("/(#([a-zA-Z0-9]){6})/","'$1'", $p5jsReturn);//#FA445F
    
    if(strpos($p5jsReturn, "function setup") === false){
        $p5jsReturn = "function setup() {" . $p5jsReturn . "}";
    }
    //Replace from begining to first assumption of program starting
    if(strpos($p5jsReturn, "var ") === false || strpos($p5jsReturn, "function setup") < strpos($p5jsReturn, "var "))
        $p5jsReturn = substr_replace($p5jsReturn, '', 0, strpos($p5jsReturn, "function setup"));
    else
        $p5jsReturn = substr_replace($p5jsReturn, '', 0, strpos($p5jsReturn, "var "));
    
    // Replace function definitions
    $p5jsReturn = preg_replace("/function\s((\w|\d)+)(\s?\(|\()([^\)]*)\)\s?\{/", "\n p.$1 = function($4) {", $p5jsReturn); 
    
    $p5jsReturn = preg_replace($pFunctions," p.$1", $p5jsReturn);
    $p5jsReturn = preg_replace($pVars,"p.$1", $p5jsReturn);
    $p5jsReturn = preg_replace("/\b(color)(\s){0,}\(/","p.$1(", $p5jsReturn);
    $p5jsReturn = preg_replace("/(println(\s)?\(.+\);)/","", $p5jsReturn);
    
    
    $p5jsReturn = "var " . $containerName . " = function( p ) { \n" . $p5jsReturn . " \n };\n\n" . "new p5(" . $containerName . ", '".$containerName."');";
    
    return $p5jsReturn;
}

$containerName = (array_key_exists("containerName", $_POST)) ? $_POST["containerName"] : null;
$pde = (array_key_exists("pde", $_POST)) ? $_POST["pde"] : null;

echo processing2p5js($containerName, $pde);

?>