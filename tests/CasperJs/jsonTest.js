//var casper = require("casper").create();

casper.test.begin('Test json return json', 1, function suite(test) {
	
	var site = 'http://127.0.0.1:8000/links.json';
	
    casper.start(site);

    casper.then(function() {
		try {
			var json_string = JSON.parse(this.getPageContent());
			test.assert(true, "OK - format is json");
		}
		catch(err) {
			test.assert(false, "KO - format isn't json");
		}
		
	});

    casper.run(function() {
        test.done();
    });
});

casper.test.begin('Test xml doesn\'t return json ', 1, function suite(test) {
	
	var site = 'http://127.0.0.1:8000/links.xml';
	
    casper.start(site);

    casper.then(function() {
		try {
			var json_string = JSON.parse(this.getPageContent());
			test.assert(false, "KO - format is json");
		}
		catch(err) {
			test.assert(true, "OK - format isn't json");
		}
		
	});

    casper.run(function() {
        test.done();
    });
});

var expectNbData;

casper.test.begin('add A link', 1, function suite(test) {
	
	var site = 'http://127.0.0.1:8000/links.json';
	
    casper.start(site)
	
	casper.then(function() {
		try {
			var json_string = JSON.parse(this.getPageContent());
			expectNbData = json_string.length+1;
			test.assert(true, "OK - format is json");
		}
		catch(err) {
			test.assert(false, "KO - format isn't json");
		}
		
	});

    casper.run(function() {
        test.done();
    });
});

casper.test.begin('Test add link', 2, function suite(test) {
	
	var site = 'http://127.0.0.1:8000/links.json';
	var nbData;
	
    casper.start(site);
	
	casper.open(site, {
	  method: 'POST',
	  data: {
				url: 'http://www.spi0n.com/ornithorynque-calins/',
			},
	  headers: {
		'Content-Type': 'application/json'
	  },
	});
	

    casper.then(function() {
		try {
			var json_string = JSON.parse(this.getPageContent());
			nbData = json_string.length;
			test.assert(true, "OK - format is json");
			test.assertEquals(parseInt(expectNbData), parseInt(nbData));
		}
		catch(err) {
			this.echo(err);
			test.assert(false, "KO - format isn't json");
		}
		
	});

    casper.run(function() {
        test.done();
    });
});