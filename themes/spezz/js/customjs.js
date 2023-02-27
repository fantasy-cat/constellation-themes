try {
    $("document").tool;
    /// start timer to check status of Constellation
    window.setInterval(check_status, 3000);
    function check_status() {
        /// get current constellation game.
        game = constellation.game();

        /// constellation isn't even running.
        if (game == null) {
            /// hide settings
            $("#settings").hide();

            /// set constellation button text
            $("#start_button").html("Calibrate (Constellation isn't running)");

            /// disable our start button
            $("#start_button").prop("disabled", true);

            /// disable the HWID button.
            $("#hwid_spoofer").prop("disabled", true);

            /// disable the reload button.
            $("#reload_scripts").prop("disabled", true);

            /// disable the exit button.
            $("#exit_button").prop("disabled", true);
            return;
        }

        /// remove our disables
        $("#start_button").prop("disabled", false);
        $("#hwid_spoofer").prop("disabled", false);
        $("#reload_scripts").prop("disabled", false);
        $("#exit_button").prop("disabled", false);

        /// show all our settings
        $("#settings").show();

        /// change text
        $("#start_button").html("Calibrate");

        /// is this game tf2
        if (game == "TF2") $("#tf2").show();
        else $("#tf2").hide();

        /// change the title
        forum = constellation.forums();
        $(document).prop("title", "fantasy.constellation - " + forum["username"]);
    }
} catch (e) {
    console.log(e);
}

/* Tooltip Code */
try {
    $(document).tooltip({
        track: true,
        position: {
            using: function (position, feedback) {
                $(this).css(position);
                $("<div>").addClass(feedback.vertical).addClass(feedback.horizontal).appendTo(this);
            },
        },
    });
} catch (e) {
    console.log(e);
}
