Local $hWnd = WinActivate("PC-Radio 6")
Send("!ea")
Send($CmdLine[1] & "{TAB}" & $CmdLine[2] & "{ENTER}")