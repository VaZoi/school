namespace WinFormsApp1
{
    public partial class Form1 : Form
    {
        public Form1()
        {
            BackColor = Color.Red;
            InitializeComponent();
            Text = "Hello!";
        }

        private bool IsRed;

        private Color SavedColor;

        private void button1_Click(object sender, EventArgs e)
        {
            if (IsRed)
            {
                SavedColor = BackColor;
                BackColor = Color.Red;
                IsRed = true;
            }
            else
            {
                BackColor = SavedColor;
                IsRed = false;
            }
        }
    }
}