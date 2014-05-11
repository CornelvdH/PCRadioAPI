/*
 * Created by SharpDevelop.
 * User: Administrator
 * Date: 11-5-2014
 * Time: 18:59
 * 
 * To change this template use Tools | Options | Coding | Edit Standard Headers.
 */
using System;
using System.Drawing;
using System.Windows.Forms;

namespace PCRAPIClient
{
	/// <summary>
	/// Description of ConnectToServerForm.
	/// </summary>
	public partial class ConnectToServerForm : Form
	{
		public string hash {get;set;}
		public string serverUrl {get;set;}
		
		public ConnectToServerForm()
		{
			//
			// The InitializeComponent() call is required for Windows Forms designer support.
			//
			InitializeComponent();
			
			//
			// TODO: Add constructor code after the InitializeComponent() call.
			//
		}
	}
}
