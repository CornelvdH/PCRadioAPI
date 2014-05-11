/*
 * Created by SharpDevelop.
 * User: Administrator
 * Date: 11-5-2014
 * Time: 15:26
 * 
 * To change this template use Tools | Options | Coding | Edit Standard Headers.
 */
using System;
using System.Windows;
using System.Windows.Forms;

namespace PCRAPIClient
{
	/// <summary>
	/// Description of Prompt.
	/// </summary>
	public static class Prompt
	{
		public static string ShowDialog(string text, string caption)
		{
			Form prompt = new Form();
			prompt.SizeGripStyle = SizeGripStyle.Hide;
			prompt.MaximizeBox = false;
			prompt.FormBorderStyle = FormBorderStyle.FixedSingle;
			prompt.Width = 500;
			prompt.Height = 150;
			prompt.Text = caption;
			Label textLabel = new Label() { Left = 50, Top=20, Text=text, Width=400 };
			TextBox textBox = new TextBox() { Left = 50, Top=50, Width=400 };
			Button confirmation = new Button() { Text = "Doorgaan", Left=350, Width=100, Top=80 };
			confirmation.Click += (sender, e) => { 
				if(textBox.Text.Length > 0) { 
					prompt.Close(); 
				} else { 
					MessageBox.Show("Geen data ingevoerd. Voer de gevraagde gegevens in om door te gaan.", "Geen data ingevoerd.", MessageBoxButtons.OK, MessageBoxIcon.Exclamation);
				} 
			};
			prompt.Controls.Add(confirmation);
			prompt.Controls.Add(textLabel);
			prompt.Controls.Add(textBox);
			prompt.FormClosing += (sender, e) => {
				if(textBox.Text.Length == 0) { 
					var result = MessageBox.Show("Geen data ingevoerd. Voer de gevraagde gegevens in om door te gaan. Druk op Annuleren om service te stoppen", "Geen data ingevoerd.", MessageBoxButtons.OKCancel, MessageBoxIcon.Exclamation);
					if(result == DialogResult.Cancel){
						Application.ExitThread();
					} else {
						e.Cancel = true;
					}
				}
			};
			prompt.ShowDialog();
			return textBox.Text;
		}
		public static string ShowDialog(string text, string caption, string inputValue)
		{
			Form prompt = new Form();
			prompt.SizeGripStyle = SizeGripStyle.Hide;
			prompt.MaximizeBox = false;
			prompt.FormBorderStyle = FormBorderStyle.FixedSingle;
			prompt.Width = 500;
			prompt.Height = 150;
			prompt.Text = caption;
			Label textLabel = new Label() { Left = 50, Top=20, Text=text, Width=400 };
			TextBox textBox = new TextBox() { Left = 50, Top=50, Width=400 };
			textBox.Text = inputValue;
			Button confirmation = new Button() { Text = "Doorgaan", Left=350, Width=100, Top=80 };
			confirmation.Click += (sender, e) => { 
				if(textBox.Text.Length > 0) { 
					prompt.Close(); 
				} else { 
					MessageBox.Show("Geen data ingevoerd. Voer de gevraagde gegevens in om door te gaan.", "Geen data ingevoerd.", MessageBoxButtons.OK, MessageBoxIcon.Exclamation);
				} 
			};
			prompt.Controls.Add(confirmation);
			prompt.Controls.Add(textLabel);
			prompt.Controls.Add(textBox);
			prompt.FormClosing += (sender, e) => {
				if(textBox.Text.Length == 0) { 
					var result = MessageBox.Show("Geen data ingevoerd. Voer de gevraagde gegevens in om door te gaan. Druk op Annuleren om service te stoppen", "Geen data ingevoerd.", MessageBoxButtons.OKCancel, MessageBoxIcon.Exclamation);
					if(result == DialogResult.Cancel){
						Application.ExitThread();
					} else {
						e.Cancel = true;
					}
				}
			};
			prompt.ShowDialog();
			return textBox.Text;
		}
	}
}
