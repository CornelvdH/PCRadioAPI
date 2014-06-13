Local $hWnd = WinActivate("PC-Radio 6")
Send("!boh")
Send($CmdLine[1])
Send("{ENTER}")
Send("{TAB}{TAB}{TAB}")
Send($CmdLine[2])
Send("{TAB}")
Send($CmdLine[3])
Send("+{TAB}+{TAB}+{TAB}+{TAB}")
Send("1")
Send("{TAB}{TAB}{TAB}")
Local $texture = $CmdLine[4]
Local $mood = $CmdLine[4]
Do
    $texture = $texture - 1;
    Send("{UP}")
Until $texture = 0
Send("{TAB}")
Do
    $mood = $mood - 1;
    Send("{UP}")
Until $mood = 0
Send("{TAB}")
Local $tempo1 = $CmdLine[5]
Local $tempo2 = $CmdLine[5]
Local $tempo3 = $CmdLine[5]
Do
    $tempo1 = $tempo1 - 1;
    Send("{UP}")
Until $tempo1 = 0
Send("{TAB}")
Do
    $tempo2 = $tempo2 - 1;
    Send("{UP}")
Until $tempo2 = 0
Send("{TAB}")
Do
    $tempo3 = $tempo3 - 1;
    Send("{UP}")
Until $tempo3 = 0
Send("{TAB}")
Local $lang = $CmdLine[6]
Do
    $lang = $lang - 1;
    Send("{DOWN}")
Until $lang = 0
Send("{TAB}")
Local $group = $CmdLine[7]
Do
    $group = $group - 1;
    Send("{DOWN}")
Until $group = 0
Send("{TAB}")
Local $planner = $CmdLine[8]
If $planner = "0" Then
    Send("{SPACE}");
EndIf
Send("{TAB}{TAB}")
Send($CmdLine[9])
Send("{TAB}{TAB}")
Local $dayGridCount = 0
Local $hourGridCount = 0
Do
    $dayGridCount = $dayGridCount + 1
    Send("+{DOWN}")
Until $dayGridCount = 7
Do
    $hourGridCount = $hourGridCount + 1
    Send("+{RIGHT}")
Until $hourGridCount = 24
Send("{SPACE}")
Local $wantedHourBegin = $CmdLine[10]
Local $amountOfHours = $CmdLine[11] - 1
Send("{HOME}{PGUP}")
Do
    $wantedHourBegin = $wantedHourBegin - 1
    Send("{RIGHT}")
Until $wantedHourBegin = 0
Local $dayGridCount2 = 0
Do
    $dayGridCount2 = $dayGridCount2 + 1
    Send("+{DOWN}")
Until $dayGridCount2 = 7
Do
    $amountOfHours = $amountOfHours - 1
    Send("+{RIGHT}")
Until $amountOfHours = 0
Send("{SPACE}")
Send("{TAB}{TAB}{TAB}{TAB}{TAB}")
Send("2")
Send("{TAB}{DOWN}")
Local $type = $CmdLine[12]
Do
    $type = $type - 1
    Send("{DOWN}")
Until $type = 0
Send("{SPACE}{DOWN}{PGUP}{RIGHT}")
Local $genre = $CmdLine[13]
Do
    $genre = $genre - 1
    Send("{DOWN}")
Until $genre = 0
Send("{SPACE}{DOWN}{PGUP}{RIGHT}")
Send("{SPACE}{DOWN}{PGUP}{RIGHT}")
Send("{SPACE}{DOWN}{PGUP}{RIGHT}")
Send("{SPACE}{DOWN}{PGUP}{RIGHT}")
Send("{SPACE}")
Send("^s")
