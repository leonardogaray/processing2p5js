PImage img;
int posX = 0;

void setup(){
  size(400,400);
  img = loadImage("covid19_1.jpg");
}

void draw(){
  background(200);
  image(img, posX, 0, 50, 50);
  posX++;
}
