#!/usr/bin/env node
const inquirer = require("inquirer");
const fs = require("fs");
const prependFile = require("prepend-file");
var npmi = require("npmi");
var path = require("path");

const theme_path = "/public_html/theme/";
const CURR_DIR = process.cwd();
const copy_to = CURR_DIR + theme_path;
let CHOICES = fs.readdirSync(`${__dirname}/templates`);
CHOICES.unshift("js-installer");

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

	if (projectChoice == "js-installer") {
		check_package_json(projectChoice);
	} else {
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

	//copy php
	copyFile(
		file_to_copy + ".php",
		copy_to + "blocks/" + projectChoice.toLowerCase() + ".php",
		logall
	);

	// //copy twig
	copyFile(
		file_to_copy + ".twig",
		copy_to + "/views/blocks/" + projectChoice.toLowerCase() + ".twig",
		logall
	);

	//install scs
	check_scss(projectChoice, file_to_copy);

	//install js
	check_js(projectChoice, file_to_copy);

	//install npm librarys
	check_package_json(projectChoice);

	//copy img folder
	check_img(projectChoice);
}
function check_scss(projectChoice, file_to_copy) {
	// //copy scss
	copyFile(
		file_to_copy + ".scss",
		copy_to + "assets/sass/blocks/" + projectChoice.toLowerCase() + ".scss",
		logall
	);

	//add css to file main.
	fs.appendFile(
		copy_to + "assets/sass/main.scss",
		'\r\n@import "blocks/' + projectChoice.toLowerCase() + '.scss"; \r\n ',
		function(err) {
			if (err) throw err;
			console.log("Saved!");
		}
	);
}

function check_js(projectChoice, file_to_copy) {
	// //copy js if
	if (fs.existsSync(file_to_copy + ".js")) {
		copyFile(
			file_to_copy + ".js",
			copy_to + "assets/scripts/" + projectChoice.toLowerCase() + ".js",
			logall
		);
		// //add js to begening of main file.
		const js_class = projectChoice.toLowerCase().replace("-", "");
		prependFile(
			copy_to + "assets/scripts/main.js",
			`import ${js_class} from "${projectChoice.toLowerCase()}.js"; \r\n"`,
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

function check_img(projectChoice) {
	const path = `${__dirname}/templates/${projectChoice}/img`;

	if (fs.existsSync(path)) {
		let images = fs.readdirSync(path);
		let img;
		for (var i = 0; i < images.length; i++) {
			img = path + "/" + images[i];
			copyFile(img, copy_to + "assets/img/" + images[i], logall);
		}
	}
}

function check_package_json(projectChoice) {
	const path = __dirname + "/templates/" + projectChoice + "/package.json";

	if (fs.existsSync(path)) {
		var obj = JSON.parse(fs.readFileSync(path, "utf8"));
		for (var k in obj.dependencies) {
			install_js_libs(k);
		}

		//check extras
		if (obj && obj.extra && typeof obj.extra !== "undefined") {
			for (var k in obj.extra) {
			
				if (k == "scss") {
					file_to_copy = `${CURR_DIR}/node_modules/${obj.extra.scss}`;

					// //copy scss
					copyFile(
						file_to_copy,
						copy_to +
							"assets/sass/blocks/" +
							projectChoice.toLowerCase() +
							"-npm.scss",
						logall
					);

					//add css to file main.
					fs.appendFile(
						copy_to + "assets/sass/main.scss",
						'\r\n@import "blocks/' +
							projectChoice.toLowerCase() +
							'-npm.scss"; \r\n ',
						function(err) {
							if (err) throw err;
							console.log("Saved!");
						}
					);
				} else if (k == "css") {
					file_to_copy = `${CURR_DIR}/node_modules/${obj.extra.css}`;

					// //copy scss
					copyFile(
						file_to_copy,
						copy_to +
							"assets/sass/blocks/" +
							projectChoice.toLowerCase() +
							"-npm.scss",
						logall
					);

					//add css to file main.
					fs.appendFile(
						copy_to + "assets/sass/main.scss",
						'\r\n@import "blocks/' +
							projectChoice.toLowerCase() +
							'-npm.scss"; \r\n ',
						function(err) {
							if (err) throw err;
							console.log("Saved!");
						}
					);
				}
			}
		}
	}
}
function install_js_libs(name) {
	var options = {
		name: name, // your module name
		version: "latest", // expected version [default: 'latest']
		path: ".", // installation path [default: '.']
		forceInstall: false, // force install if set to true (even if already installed, it will do a reinstall) [default: false]
		npmLoad: {
			// npm.load(options, callback): this is the "options" given to npm.load()
			loglevel: "silent" // [default: {loglevel: 'silent'}]
		}
	};
	npmi(options, function(err, result) {
		if (err) {
			if (err.code === npmi.LOAD_ERR) console.log("npm load error");
			else if (err.code === npmi.INSTALL_ERR)
				console.log("npm install error");
			return console.log(err.message);
		}
		// installed
		console.log(
			options.name +
				"@" +
				options.version +
				" installed successfully in " +
				path.resolve(options.path)
		);
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