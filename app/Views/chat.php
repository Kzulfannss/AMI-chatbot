<html>

<head>
    <meta http-equiv="Content-Type" content="text/html;charset=utf-8">
    <link rel="shortcut icon" href="https://github.githubassets.com/favicons/favicon-dark.png" />
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <title>AMI</title>
    <script src="https://code.jquery.com/jquery-1.12.4.js" integrity="sha256-Qw82+bXyGq6MydymqBxNPYTaUXXq7c8v3CwiYwLLNXU=" crossorigin="anonymous"></script>
</head>
<style type="text/css">
    * {
        font-family: "Poppins", sans-serif;
    }

    body {
        display: flex;
        justify-content: center;
    }

    .chatbot-container {
        width: 1000px;
        margin: 0 auto;
        background-color: #f5f5f5;
        border: 1px solid #cccccc;
        border-radius: 50px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    #chatbot {
        background-color: #f5f5f5;
        border: 1px solid #eef1f5;
        box-shadow: 0 2px 6px 0 rgba(0, 0, 0, 0.1);
        border-radius: 4px;
    }

    #header {
        background-color: purple;
        color: #ffffff;
        padding: 20px;
        font-size: 1em;
        font-weight: bold;
        text-align: center;
        border-top-left-radius: 20px;
        border-top-right-radius: 20px;
    }

    message-container {
        background: #ffffff;
        width: 100%;
        display: flex;
        align-items: center;
        border-radius: 20px;
    }


    #conversation {
        height: 500px;
        overflow-y: auto;
        padding: 20px;
        display: flex;
        flex-direction: column;
    }

    @keyframes message-fade-in {
        from {
            opacity: 0;
            transform: translateY(-20px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .chatbot-message {
        display: flex;
        align-items: flex-start;
        position: relative;
        font-size: 16px;
        line-height: 20px;
        border-radius: 20px;
        word-wrap: break-word;
        white-space: pre-wrap;
        max-width: 100%;
        padding: 0 15px;
    }

    .user-message {
        justify-content: flex-end;
    }


    .chatbot-text {
        background-color: white;
        color: #333333;
        font-size: 1.1em;
        padding: 15px;
        border-radius: 5px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    #input-form {
        display: flex;
        align-items: center;
        border-top: 1px solid #eef1f5;
        border-radius: 20px;
    }

    #input-field {
        flex: 1;
        height: 60px;
        border: 1px solid #eef1f5;
        border-radius: 20px;
        padding: 0 10px;
        font-size: 14px;
        transition: border-color 0.3s;
        background: #ffffff;
        color: #333333;
        border: none;
    }

    .send-icon {
        margin-right: 10px;
        cursor: pointer;
    }

    #input-field:focus {
        border-color: #333333;
        outline: none;
    }

    #submit-button {
        background-color: transparent;
        border: none;
    }

    p[sentTime]:hover::after {
        content: attr(sentTime);
        position: absolute;
        top: -3px;
        font-size: 14px;
        color: gray;
    }

    .chatbot p[sentTime]:hover::after {
        left: 15px;
    }

    .user-message p[sentTime]:hover::after {
        right: 15px;
    }


    /* width */
    ::-webkit-scrollbar {
        width: 10px;
    }

    /* Track */
    ::-webkit-scrollbar-track {
        background: #f1f1f1;
    }

    /* Handle */
    ::-webkit-scrollbar-thumb {
        background: #888;
    }

    /* Handle on hover */
    ::-webkit-scrollbar-thumb:hover {
        background: #555;
    }

    .avatar {
        padding-top: 30px;
        padding-right: 15px;
        width: 30px;
        height: 30px;
    }
    .cursor-pointer {
        cursor: pointer;
    }
    .chatbot-text-reply {
        background-color: white;
        color: #333333;
        font-size: 1.1em;
        padding: 15px;
        border-radius: 5px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        margin: 2px;
        margin-left: 45px;
    }
</style>

<body id="body">
    <div class="chatbot-container">
        <div id="header">
            <img src="https://pmm.kampusmerdeka.kemdikbud.go.id/files/logopt/051024.png" alt="" style="width:80px;height:80px;">
            <h1>AMI</h1>
        </div>
        <div id="chatbot">
            <div id="conversation">
                <div class="chatbot-message">
                    <img src='https://pmm.kampusmerdeka.kemdikbud.go.id/files/logopt/051024.png' class='avatar'>
                    <p class="chatbot-text">Hi! 👋 Selamat Datang..</p>
                </div>
                <div class="chatbot-message">
                    <img src='https://pmm.kampusmerdeka.kemdikbud.go.id/files/logopt/051024.png' class='avatar'>
                    <p class="chatbot-text">Ayo tanyakan sesuatu!</p>
                </div>
            </div>
            <form id="input-form">
                <message-container>
                    <input id="input-field" type="text" placeholder="Tulis pertanyaanmu disini" name="userInput">
                    <button id="submit-button">
                        <img class="send-icon" src="https://raw.githubusercontent.com/AkashThoriya/chatbot/main/send-message.png" alt="">
                    </button>
                </message-container>
            </form>
        </div>
    </div>
</body>
<script type="text/javascript">
    $(document).ready(function() {

        const conversation = document.getElementById('conversation');

        var localUrl = window.location.href;
        localUrl = localUrl.replace('web/', '');

        // só um advinhador simples
        var webServiceUrl = "<?= base_url('test') ?>"
        console.log(webServiceUrl);

        const getData = async (text) => {
            console.log('loaded')
            // get user input
            var userInput = $('input[name="userInput"]').val();

            // basic check
            if (userInput == '' && !text)
                return false;
            //

            // clear
            $('input[name="userInput"]').val('');

            // hide button
            $(this).hide();

            // show user input
            AddText('A ', text !== null ? text : userInput, 'input');

            $.ajax({
                type: "GET",
                url: webServiceUrl,
                data: {
                    userInput: text != null ? text : userInput,
                    requestType: 'talk'
                },
                success: function(response) {
                    console.log(webServiceUrl);
                    console.log(userInput);
                    var dataArray = Object.values(response.data).map(obj => obj);

                    console.log(dataArray);
                    let formattedText = response.message.replace(/{{enter}}/g, "<br>");
                    var pattern = /{{link}}(.*?){{\/link}}/g;

                    // Function to replace the placeholders with <a> tags
                    function replaceLinks(match, linkText) {
                        return '<a href="' + linkText + '" target="blank">' + linkText + '</a>';
                    }

                    // Replace the placeholders with <a> tags within a <div>
                    formattedText = formattedText.replace(pattern, replaceLinks);


                    AddText('B ', formattedText, 'bot');

                    dataArray.map((item, index) => {
                        return (
                            AddText('B', item, 'reply')
                        )
                    })

                    $('#input-form').show();
                    $('input[name="userInput"]').focus();
                },
                error: function(request, status, error) {
                    console.log(error);
                    alert('error');
                    $('#input-form').show();
                }
            });
        }


        $('#input-form').submit(function() {

            getData(null);

            return false;
        });


        $(document).on('click', '#reply', function(e) {
            let action = $(this).data('action')
            // alert(action)
            getData(action)
        });

        

        function AddText(user, msg, type) {
            let message = document.createElement('div');
            const currentTime = new Date().toLocaleTimeString([], {
                hour: '2-digit',
                minute: "2-digit"
            });
            if (type == 'input') {
                message.classList.add('chatbot-message', 'user-message');
                message.innerHTML = `<p class="chatbot-text" sentTime="${currentTime}">${msg}</p>`;
                conversation.appendChild(message);
            } else if (type == 'reply') {
                message.classList.add('chatbot-message', 'chatbot');
                message.innerHTML = `<p class="chatbot-text-reply cursor-pointer"  id='reply' data-action="${msg.action}">${msg.text}</p>`;
                conversation.appendChild(message);
            } else {
                message.classList.add('chatbot-message', 'chatbot');
                message.innerHTML = `<img src='https://pmm.kampusmerdeka.kemdikbud.go.id/files/logopt/051024.png' class='avatar'> <p class="chatbot-text" sentTime="${currentTime}">${msg}</p>`;
                conversation.appendChild(message);
            }
            message.scrollIntoView({
                behavior: "smooth"
            });
        }


    });
</script>
</html>