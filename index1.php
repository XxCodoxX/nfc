<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

</head>

<body>
    <button id="scanButton">Scan</button>


    <input readonly placeholder="somthing" value="" id="scaninput" name="scaninput">

    <script>
        NfcManager manager = (NfcManager) context.getSystemService(Context.NFC_SERVICE);
        NfcAdapter adapter = manager.getDefaultAdapter();
        if (adapter != null && adapter.isEnabled()) {

            //Yes NFC available 
        } else if (adapter != null && !adapter.isEnabled()) {

            //NFC is not enabled.Need to enable by the user.
        } else {
            //NFC is not supported
        }





        log = ChromeSamples.log;

        if (!("NDEFReader" in window))
            ChromeSamples.setStatus(
                "Web NFC is not available.\n" +
                'Please make sure the "Experimental Web Platform features" flag is enabled on Android.'
            );


        scanButton.addEventListener("click", async () => {
            // log("User clicked scan button");
            alert("User clicked scan button");

            try {
                const ndef = new NDEFReader();
                await ndef.scan();
                alert("> Scan started");

                ndef.addEventListener("readingerror", () => {
                    alert("Argh! Cannot read data from the NFC tag. Try another one?");
                    $("#scaninput").val("readingerror");
                });

                ndef.addEventListener("reading", ({
                    message,
                    serialNumber,

                }) => {
                    $("#scaninput").val("Reding done");
                    // log(`> Serial Number: ${serialNumber}`);
                    alert(`> Serial Number: ${serialNumber}`);
                    // log(`> Records: (${message.records.length})`);
                });
            } catch (error) {
                // log("Argh! " + error);
                alert("Argh! " + error);
                $("#scaninput").val("Error");
            }
        });
    </script>

</body>

</html>