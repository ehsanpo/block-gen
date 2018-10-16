#!/usr/bin/env node
const inquirer = require("inquirer");
const fs = require("fs");
const theme_path = "/public_html/theme/";
const prependFile = require("prepend-file");
var npmi = require('npmi');
var path = require('path');

const CURR_DIR = process.cwd();
let  CHOICES = fs.readdirSync(`${__dirname}/templates`);
CHOICES  = CHOICES.push('js-installer');

if (!fs.existsSync(`${process.cwd()}/public_html`)) {
	console.log("wrong dir");
	console.log(`${process.cwd()}/public_html`);
	process.exit();
}

const QUESTIONS = [
	{
		name: "project-block",
		type: "list",
		message: "What project template would you like to generate?",
		choices: CHOICES
	},
	{
		name: "project-name",
		type: "input",
		message: "Project name:",
		validate: function(input) {
			if (/^([A-Za-z\-\_\d])+$/.test(input)) return true;
			else
				return "Project name may only include letters, numbers, underscores and hashes.";
		}
	}
];

inquirer.prompt(QUESTIONS).then(answers => {
	const projectChoice = answers["project-block"];
	const projectName = answers["project-name"];
	const templatePath = `${__dirname}/templates/${projectChoice}`;

	if (projectChoice == 'js-installer') {
		install_js_libs();
	}
	else{
		createDirectoryContents(templatePath, projectName, projectChoice);
	}
	//fs.mkdirSync(`${CURR_DIR}/${projectName}`);

	
});

function logall(verb) {
	console.log(verb);
}

function createDirectoryContents(templatePath, newProjectPathm, projectChoice) {
	const filesToCreate = fs.readdirSync(templatePath);
	file_to_copy =
		__dirname + "/templates/" + projectChoice + "/" + projectChoice;
	copy_to = CURR_DIR + theme_path;

	//copy php
	copyFile(
		file_to_copy + ".php",
		copy_to + "blocks/" + projectChoice + ".php",
		logall
	);

	// //copy scss
	copyFile(
		file_to_copy + ".scss",
		copy_to + "assets/sass/blocks/" + projectChoice + ".scss",
		logall
	);

	//add css to file main.
	fs.appendFile(
		copy_to + "assets/sass/main.scss",
		'\r\n@import "blocks/' + projectChoice + '.scss"; \r\n ',
		function(err) {
			if (err) throw err;
			console.log("Saved!");
		}
	);

	// //copy twig
	copyFile(
		file_to_copy + ".twig",
		copy_to + "/views/blocks/" + projectChoice + ".twig",
		logall
	);
	// fs.createReadStream(file_to_copy +'.twig' ).pipe(fs.createWriteStream(copy_to + '/views/blocks/'+  projectChoice +'.twig'));

	// //copy js if
	if (fs.existsSync(file_to_copy + ".js")) {
		copyFile(
			file_to_copy + ".js",
			copy_to + "assets/scripts/" + projectChoice + ".js",
			logall
		);
		// //add css to begening of main file.
		const js_class = projectChoice.replace("-", "");
		prependFile(
			copy_to + "assets/scripts/main.js",
			`import ${js_class} from "${projectChoice}.js"; \r\n"`,
			function(err) {
				if (err) {
					// Error
				}

				// Success
				console.log('The "data to prepend" was prepended to file!');
			}
		);
	}
}
function install_js_libs(){

 var options = {
    name: 'slick-carousel',	// your module name
    version: 'latest',		// expected version [default: 'latest']
    path: '.',				// installation path [default: '.']
    forceInstall: false,	// force install if set to true (even if already installed, it will do a reinstall) [default: false]
    npmLoad: {				// npm.load(options, callback): this is the "options" given to npm.load()
        loglevel: 'silent'	// [default: {loglevel: 'silent'}]
    }
};
npmi(options, function (err, result) {
    if (err) {
        if 		(err.code === npmi.LOAD_ERR) 	console.log('npm load error');
        else if (err.code === npmi.INSTALL_ERR) console.log('npm install error');
        return console.log(err.message);
    }
 
    // installed
    console.log(options.name+'@'+options.version+' installed successfully in '+path.resolve(options.path));
});


}

function copyFile(source, target, cb) {
	var cbCalled = false;

	var rd = fs.createReadStream(source);
	rd.on("error", function(err) {
		done(err);
	});
	var wr = fs.createWriteStream(target);
	wr.on("error", function(err) {
		done(err);
	});
	wr.on("close", function(ex) {
		done();
	});
	rd.pipe(wr);

	function done(err) {
		if (!cbCalled) {
			cb(err);
			cbCalled = true;
		}
	}
}