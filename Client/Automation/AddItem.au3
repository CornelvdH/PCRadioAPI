Local $hWnd = WinActivate("PC-Radio 6")
;Send("^{INS}")
Send("{F11}")
Send("!bet")
Send("2014-06-11 Databank.txt{ENTER}")
Local $closeHandle = WinWaitActive("[CLASS:Notepad]")
WinClose($closeHandle)