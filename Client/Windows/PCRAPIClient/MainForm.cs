/*
 * Created by SharpDevelop.
 * User: Administrator
 * Date: 11-5-2014
 * Time: 12:32
 * 
 * To change this template use Tools | Options | Coding | Edit Standard Headers.
 */
using System;
using System.Collections.Generic;
using System.Drawing;
using System.Windows.Forms;
using System.IO;
using Microsoft.VisualBasic;

namespace PCRAPIClient
{
	/// <summary>
	/// Description of MainForm.
	/// </summary>
	public partial class MainForm : Form
	{
		public MainForm()
		{
			//
			// The InitializeComponent() call is required for Windows Forms designer support.
			//
			InitializeComponent();
			
			//
			// TODO: Add constructor code after the InitializeComponent() call.
			//
		}
		private string settingsFile = "%appdata%\\PCRClientData.ini";
		public IniFile ini;
		public string filePath;
		void Button1Click(object sender, EventArgs e)
		{
			Application.ExitThread();
		}
		
		void MainFormLoad(object sender, EventArgs e)
		{
			MessageBox.Show(Environment.MachineName + ", " + Environment.OSVersion + ", " + Environment.UserName);
			filePath = Environment.ExpandEnvironmentVariables(settingsFile);
			if(File.Exists(filePath)){
				textBox2.Text = filePath;
				LoadINIData();
			} else {
				var result = MessageBox.Show("Het instellingen-bestand bestaat niet.\nWilt u deze aanmaken? Zonder bestand kunt u de service niet starten.", "Instellingen niet gevonden", MessageBoxButtons.YesNo, MessageBoxIcon.Exclamation);
				if(result == DialogResult.Yes){
					//string server = Prompt.ShowDialog("Voer Server URL in:", "Instellingen bevestigen");
					
				} else {
					MessageBox.Show("Applicatie zal nu sluiten.", "Afsluiten...", MessageBoxButtons.OK, MessageBoxIcon.Error);
					Application.ExitThread();
				}
			}
		}
		
		void LoadINIData(){
			ini = new IniFile();
			ini.Load(filePath);
			textBox1.Text = ini.GetKeyValue("GlobalSettings", "KeepAliveServer");
			textBox3.Text = ini.GetKeyValue("GlobalSettings", "ExecFolder");
		}
		
		void MainFormResize(object sender, EventArgs e)
		{
			if(FormWindowState.Minimized == this.WindowState){
				notifyIcon1.Visible = true;
				notifyIcon1.BalloonTipText = "PC-Radio API Client zal als service op de achtergrond blijven draaien.";
				notifyIcon1.BalloonTipTitle = "PC-Radio API Client";
				notifyIcon1.BalloonTipIcon = ToolTipIcon.Info;
				//notifyIcon1.ShowBalloonTip(500);
				this.Hide();
			} else if (FormWindowState.Normal == this.WindowState){
				notifyIcon1.Visible = false;
			}
		}
		void NotifyIcon1DoubleClick(object sender, EventArgs e)
		{
			this.Show();
			this.WindowState = FormWindowState.Normal;
		}
		void MainFormFormClosing(object sender, FormClosingEventArgs e)
		{
			this.WindowState = FormWindowState.Minimized;
			e.Cancel = true;
		}
		
		void ToolStripMenuItem2Click(object sender, EventArgs e)
		{
			this.Show();
			this.WindowState = FormWindowState.Normal;
		}
		
		void GroupBox1Enter(object sender, EventArgs e)
		{
			
		}
		
		void Button3Click(object sender, EventArgs e)
		{
			string execPath = Prompt.ShowDialog("Executable-pad bewerken", "Executable-pad", textBox3.Text);
			textBox3.Text = execPath;
		}
		
		void TextBox1TextChanged(object sender, EventArgs e)
		{
			
		}
		
		void Button4Click(object sender, EventArgs e)
		{
			string execPath = Prompt.ShowDialog("Server URL bewerken", "Server URL", textBox1.Text);
			textBox1.Text = execPath;
		}
		
		void Button2Click(object sender, EventArgs e)
		{
			ini.SetKeyValue("GlobalSettings", "KeepAliveServer", textBox1.Text);
			ini.SetKeyValue("GlobalSettings", "ExecFolder", textBox3.Text);
			ini.Save(filePath);
			MessageBox.Show("Instellingen opgeslagen", "Instellingen");
		}
	}
}
