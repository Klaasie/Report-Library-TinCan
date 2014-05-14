    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>-->
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/docs.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            $('.star-rating').each(function(ind, ev){
                $(ev).raty({
                    path: '../js/images',
                    score: Math.floor((Math.random() * 5) + 1)
                });
            });
        });

    </script>
</body>
</html>