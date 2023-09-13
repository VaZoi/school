using System.Windows.Forms;

namespace Gane
{
    public partial class Form1 : Form
    {
        public Form1()
        {
            InitializeComponent();
        }

        
        int YDirection = 1;

        int XDirection = 1;

        int MoveY = 20;

        int MoveX = 20;

        private void pictureBox1_Click(object sender, EventArgs e)
        {
            var oldLocation = pictureBox1.Location;
            pictureBox1.Location = new Point(oldLocation.X + 20, oldLocation.Y + 20);
        }



        private void timer1_Tick(object sender, EventArgs e)
        {
            var oldlocation = pictureBox1.Location;
            var x = oldlocation.X + XDirection * MoveX;
            var y = oldlocation.Y + YDirection * MoveY;
            var newLocation = new Point(x, y);

            if (newLocation.Y + pictureBox1.Height > Height - 50 || newLocation.Y < 0)
            {
                YDirection = -YDirection;
                return;
            }

            if (newLocation.X + pictureBox1.Width > Width || newLocation.X < 0)
            {
                XDirection = -XDirection;
                return;
            }

            pictureBox1.Location = newLocation;
        }


    }
}