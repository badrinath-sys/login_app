
/*
 *
 * Ref = https://docs.aws.amazon.com/amazondynamodb/latest/developerguide/GettingStarted.Js.01.html
 */

//var newsid = 123456;

var today = new Date();
var dd = today.getDate();
var mm = today.getMonth() + 1;
var yyyy = today.getFullYear();
var msec = yyyy * 10000 + mm * 100 + dd;
var tablename = "ee_user_readcount_" + msec;
var currentTime = getDateTime();

$(document).ready(function () {

    if (typeof (newsid) != "undefined") {
	console.log(newsid);
	console.log(newsurl);
        /*
         * Include AWS DynamoDB SDK JS
         */
        var sdkjs = "https://sdk.amazonaws.com/js/aws-sdk-2.7.16.min.js";
        $.getScript(sdkjs, function ()
        {
            AWS.config.update({
                region: "ap-south-1",
                accessKeyId: "AKIAT3ASO5XF2X3NYBVZ",
                secretAccessKey: "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"
            });

            var dynamodb = new AWS.DynamoDB();
            var docClient = new AWS.DynamoDB.DocumentClient();

            /*
             * Creating Table
             */
            var params = {
                TableName: tablename
            };
            dynamodb.describeTable(params, function (err, data) {
                if (err) {
                    var createparams = {
                        KeySchema: [
                            {AttributeName: "count_newsid", KeyType: "HASH"}
                        ],
                        AttributeDefinitions: [
                            {AttributeName: "count_newsid", AttributeType: "N"},
			    { AttributeName: "news_url", AttributeType: "S" },
			    { AttributeName: "read_timing", AttributeType: "S" }
                        ],
                        TableName: tablename,
                        ProvisionedThroughput: {
                            ReadCapacityUnits: 5,
                            WriteCapacityUnits: 5
                        }
                    };

                    dynamodb.createTable(createparams, function (err, data) {
                        console.log(err);
                        console.log(data);
                        if (!err) {
                            /*
                             * Update the Table Billing Mode once created
                             */
                            var updtableparams = {
                                TableName: tablename,
                                BillingMode: "PAY_PER_REQUEST"
                            };
                            dynamodb.updateTable(updtableparams, function (err, data) {
                                console.log(err);
                                console.log(data);
                            });
                        }
                    });
                } else {
//                    console.log(data);
                }
            });

            /*
             * Update Table
             */

            var updparams = {
                TableName: tablename,
                Key: {
                    "count_newsid": parseInt(newsid)
                },
                UpdateExpression: "set count_readcount = count_readcount + :r, news_url = :u, read_timing = :t",
                ExpressionAttributeValues: {
                    ":r": 1, 
		    ":u": newsurl,
		    ":t": currentTime
                },
                ReturnValues: "UPDATED_NEW"
            };

            docClient.update(updparams, function (err, data) {
//                console.log(err);
//                console.log(data);
                if (err) {

                    /*
                     * Insert into Table
                     */

                    var insparams = {
                        TableName: tablename,
                        Item: {
                            "count_newsid": parseInt(newsid),
                            "count_readcount": 1,
                            "news_url": newsurl, 
			    "read_timing" : currentTime
                        }
                    };

                    docClient.put(insparams, function (err, data) {
//                        console.log(err);
//                        console.log(data);
                    });
                }
            });

        });
    }

})


function getDateTime() {
        var now     = new Date(); 
        var year    = now.getFullYear();
        var month   = now.getMonth()+1; 
        var day     = now.getDate();
        var hour    = now.getHours();
        var minute  = now.getMinutes();
        var second  = now.getSeconds(); 
        if(month.toString().length == 1) {
             month = '0'+month;
        }
        if(day.toString().length == 1) {
             day = '0'+day;
        }   
        if(hour.toString().length == 1) {
             hour = '0'+hour;
        }
        if(minute.toString().length == 1) {
             minute = '0'+minute;
        }
        if(second.toString().length == 1) {
             second = '0'+second;
        }   
        var dateTime = year+'-'+month+'-'+day+' '+hour+':'+minute+':'+second;   
         return dateTime;
}
