const canvas = document.getElementById('petal-blossom');
const context = canvas.getContext('2d');

//Make the area available for the petals to be the whole image area
function resizeCanvas() {
    const hero = canvas.parentElement;
    canvas.width = hero.offsetWidth;  //width of hero img
    canvas.height = hero.offsetHeight;  //height of hero img
}

resizeCanvas();

//Resize the area available on viewport resize
window.addEventListener('resize', resizeCanvas);

// Load image
const petalImage = new Image();
petalImage.src = 'javascript/img/petal4.png';

class Petal {
    constructor() {
        //Starting position in the top right quandrant 
        this.x = Math.random() * (canvas.width * 0.5) + canvas.width * 0.5;  //50% to 100% width
        this.y = Math.random() * (canvas.height * 0.5);  //0 to 50% height
        //Petal size
        this.size = Math.random() * 35 + 25;  //size in pixels
        //Fall speed
        this.speedX = -(Math.random() + 0.5);  //negative for moving left
        this.speedY = Math.random() + 0.5;  //positive for moving down
        //Rotation of petal while falling
        this.rotation = Math.random() * 360;
        this.rotationSpeed = (Math.random() - 0.5) * 2;
    }

    update() {
        //Updating the petal positions based on its speed
        this.x += this.speedX;
        this.y += this.speedY;
        //Updating the petal rotation angle based on its rotation speed
        this.rotation += this.rotationSpeed;

        //Resets and gives a new start position for petals fallen out of frame 
        if (this.y > canvas.height || this.x + this.size < 0) {
            this.x = Math.random() * (canvas.width * 0.5) + canvas.width * 0.5; 
            this.y = Math.random() * (canvas.height * 0.5); 
        }
    }

    draw(context) {
        //Save and Restore to ensure each petal can rotate and move independantly
        context.save();
        //Starting points
        context.translate(this.x, this.y);
        //Rotate petals
        context.rotate(this.rotation * Math.PI / 180); //change to degrees rather than radians
        // 3D-like rotation
        const flutter = Math.cos(this.rotation * Math.PI / 90);  //last number alters the speed of 'flip', the lower the number the higher the speed
        context.scale(flutter, 1); // Horizontal flip and squish/stretch
        //
        context.drawImage(petalImage, -this.size / 2, -this.size / 2, this.size, this.size);
        context.restore();
    }
}

petalImage.onload = () => {
    //Empty array for the petals
    const petals = [];

    //Creating a certain number of petals (30 in my case)
    for (let i = 0; i < 30; i++) {
        petals.push(new Petal());
    }

    function animate() {
        context.clearRect(0, 0, canvas.width, canvas.height);
        petals.forEach(petal => {
            petal.update();
            petal.draw(context);
        });
        requestAnimationFrame(animate);
    }

    animate();  // only start after image loads
}

petalImage.onerror = () => {
  console.error('Failed to load petal image. - blossom.js:87');
};
