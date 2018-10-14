$(function(){
    // $("#de_year").attr({selected:"selected"});
    $("#search").click(function()
    {
        $.ajax({
            type:'POST',
            url:'babynames.php',
            data: {year:$("#year").val(),sex:$("#sex").val()},
            dataType:"json",
            success:function(data)
            {
                // console.log(111);
                var result="";
                result+="<table border='solid'><tr><th>Name</th><th>Gender</th><th>Year</th><th>Ranking</th></tr>";
                $.each(data,function(index,row)
                {
                    //console.log(row["name"]);
                    var gender;
                    if(row.gender=="m")
                    {
                        gender="male";
                    }
                    else
                    {
                        gender="female";
                    }
                    result+="<tr><td>"+row.name+"</td><td>"+gender+"</td><td>"+row.year+"</td><td>"+row.ranking+"</td></tr>";
                })
                result+="</table>";
                //console.log(result);
                $("#result").html(result);
            }
        });
    })
});
