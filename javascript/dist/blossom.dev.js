"use strict";

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

function _defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } }

function _createClass(Constructor, protoProps, staticProps) { if (protoProps) _defineProperties(Constructor.prototype, protoProps); if (staticProps) _defineProperties(Constructor, staticProps); return Constructor; }

var canvas = document.getElementById('petal-blossom');
var context = canvas.getContext('2d'); //Make the area available for the petals to be the whole image area

function resizeCanvas() {
  var hero = canvas.parentElement;
  canvas.width = hero.offsetWidth; //width of hero img

  canvas.height = hero.offsetHeight; //height of hero img
}

resizeCanvas(); //Resize the area available on viewport resize

window.addEventListener('resize', resizeCanvas); // Load image

var petalImage = new Image();
petalImage.src = 'javascript/img/petal4.png';

var Petal =
/*#__PURE__*/
function () {
  function Petal() {
    _classCallCheck(this, Petal);

    //Starting position in the top right quandrant 
    this.x = Math.random() * (canvas.width * 0.5) + canvas.width * 0.5; //50% to 100% width

    this.y = Math.random() * (canvas.height * 0.5); //0 to 50% height
    //Petal size

    this.size = Math.random() * 35 + 25; //size in pixels
    //Fall speed

    this.speedX = -(Math.random() + 0.5); //negative for moving left

    this.speedY = Math.random() + 0.5; //positive for moving down
    //Rotation of petal while falling

    this.rotation = Math.random() * 360;
    this.rotationSpeed = (Math.random() - 0.5) * 2;
  }

  _createClass(Petal, [{
    key: "update",
    value: function update() {
      //Updating the petal positions based on its speed
      this.x += this.speedX;
      this.y += this.speedY; //Updating the petal rotation angle based on its rotation speed

      this.rotation += this.rotationSpeed; //Resets and gives a new start position for petals fallen out of frame 

      if (this.y > canvas.height || this.x + this.size < 0) {
        this.x = Math.random() * (canvas.width * 0.5) + canvas.width * 0.5;
        this.y = Math.random() * (canvas.height * 0.5);
      }
    }
  }, {
    key: "draw",
    value: function draw(context) {
      //Save and Restore to ensure each petal can rotate and move independantly
      context.save(); //Starting points

      context.translate(this.x, this.y); //Rotate petals

      context.rotate(this.rotation * Math.PI / 180); //change to degrees rather than radians
      // 3D-like rotation

      var flutter = Math.cos(this.rotation * Math.PI / 90); //last number alters the speed of 'flip', the lower the number the higher the speed

      context.scale(flutter, 1); // Horizontal flip and squish/stretch
      //Draw the petal

      context.drawImage(petalImage, -this.size / 2, -this.size / 2, this.size, this.size);
      context.restore();
    }
  }]);

  return Petal;
}(); //When the image is loaded


petalImage.onload = function () {
  //Empty array for the petals
  var petals = []; //Creating a certain number of petals (30 in my case)

  for (var i = 0; i < 30; i++) {
    petals.push(new Petal());
  }

  function animate() {
    //Make sure they don't leave any trails behind
    context.clearRect(0, 0, canvas.width, canvas.height); //Each frame is drawn fresh, allowing objects like petals to move smoothly without leaving marks behind

    for (var _i = 0, _petals = petals; _i < _petals.length; _i++) {
      var petal = _petals[_i];
      petal.update();
      petal.draw(context);
    }

    ;
    requestAnimationFrame(animate); //Ensures smooth animation
  }

  animate(); // only start after image loads
}; //Error check to mkae sure the image loads


petalImage.onerror = function () {
  console.error('Failed to load petal image. - blossom.js:90');
};
//# sourceMappingURL=blossom.dev.js.map
