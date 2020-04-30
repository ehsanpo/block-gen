#!/usr/bin/env node
const inquirer = require("inquirer");
const fs = require("fs");
const prependFile = require("prepend-file");
const npmi = require("npmi");
const path = require("path");
const { join } = require("path");
const { readdirSync, statSync } = require("fs");

const theme_path = "/web/app/themes/Blockpress/";
const CURR_DIR = process.cwd();
const copy_to = CURR_DIR + theme_path;
const CHOICES = (p) =>
	readdirSync(`${__dirname}/templates`).filter((f) =>
		statSync(join(`${__dirname}/templates`, f)).isDirectory()
	);
const red_text = "\x1b[31m";
const cyan_text = "\x1b[36m";

//Check if we are in right DIR
if (!fs.existsSync(`${process.cwd()}/webl`)) {
	console.log(red_text, "Wrong dir! Can not find web in this folder");
	process.exit();
}

const QUESTIONS = [
	{
		name: "project-block",
		type: "list",
		message: "What Block template would you like to generate?",
		choices: CHOICES,
	},
];

inquirer.prompt(QUESTIONS).then((answers) => {
	const projectChoice = answers["project-block"];
	const templatePath = `${__dirname}/templates/${projectChoice}`;
	_main(templatePath, projectChoice);
});

function logall(verb) {
	console.log(verb);
}

function _main(templatePath, projectChoice) {
	copy_block_img(projectChoice);

	const filesToCreate = fs.readdirSync(templatePath);
	file_to_copy =
		__dirname + "/templates/" + projectChoice + "/" + projectChoice;

	//copy php
	copyFile(
		file_to_copy + ".php",
		copy_to + "blocks/" + projectChoice.toLowerCase() + ".php",
		logall,
		"Copy PHP"
	);

	// //copy twig
	copyFile(
		file_to_copy + ".twig",
		copy_to + "/views/blocks/" + projectChoice.toLowerCase() + ".twig",
		logall,
		"Copy twig"
	);

	//install scs
	check_scss(projectChoice, file_to_copy);

	//install js
	check_js(projectChoice, file_to_copy);

	//install npm librarys
	check_package_json(projectChoice);

	//copy img folder
	check_img(projectChoice);

	//Show info file
	fs.readFile(file_to_copy + ".txt", "utf8", function (err, data) {
		err
			? Function("error", "throw error")(err)
			: console.log(cyan_text, data);
	});
}
function check_scss(projectChoice, file_to_copy) {
	// //copy scss
	copyFile(
		file_to_copy + ".scss",
		copy_to + "assets/sass/blocks/" + projectChoice.toLowerCase() + ".scss",
		logall,
		"Copy Scss"
	);

	//add css to file main.
	fs.appendFile(
		copy_to + "assets/sass/main.scss",
		'\r\n@import "blocks/' + projectChoice.toLowerCase() + '.scss"; \r\n ',
		function (err) {
			if (err) throw err;
			console.log("Add scss to main file");
		}
	);
}

function check_js(projectChoice, file_to_copy) {
	// //copy js if
	if (fs.existsSync(file_to_copy + ".js")) {
		copyFile(
			file_to_copy + ".js",
			copy_to + "assets/scripts/" + projectChoice.toLowerCase() + ".js",
			logall,
			"Copy JS"
		);
		// //add js to begening of main file.
		const js_class = projectChoice.toLowerCase().replace("-", "");
		prependFile(
			copy_to + "assets/scripts/main.js",
			`import ${js_class} from "./${projectChoice.toLowerCase()}.js"; \r\n`,
			function (err) {
				if (err) {
					console.log(red_text, "Can copy file");
				}
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
			copyFile(
				img,
				copy_to + "assets/img/" + images[i],
				logall,
				"Copy image"
			);
		}
	}
}

function copy_block_img(projectChoice) {
	const img = `${__dirname}/templates/${projectChoice}/${projectChoice}.png`;
	copyFile(
		img,
		copy_to + "assets/img/blocks/" + projectChoice.toLowerCase() + ".png",
		logall,
		"Copy Block image"
	);
}

function check_package_json(projectChoice) {
	const path = __dirname + "/templates/" + projectChoice + "/package.json";
	projectChoice = projectChoice.toLowerCase();
	if (fs.existsSync(path)) {
		var obj = JSON.parse(fs.readFileSync(path, "utf8"));
		for (var k in obj.dependencies) {
			install_js_libs(k, projectChoice);
		}
	}
}
function copy_npm_assets(projectChoice) {
	const path = __dirname + "/templates/" + projectChoice + "/package.json";
	projectChoice = projectChoice.toLowerCase();
	if (fs.existsSync(path)) {
		var obj = JSON.parse(fs.readFileSync(path, "utf8"));

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
							projectChoice +
							"-npm.scss",
						logall,
						"Copy npm scss"
					);

					//add css to file main.
					fs.appendFile(
						copy_to + "assets/sass/main.scss",
						'\r\n@import "blocks/' +
							projectChoice +
							'-npm.scss"; \r\n ',
						function (err) {
							if (err) throw err;
							console.log("Copy npm scss");
						}
					);
				} else if (k == "css") {
					file_to_copy = `${CURR_DIR}/node_modules/${obj.extra.css}`;

					// //copy scss
					copyFile(
						file_to_copy,
						copy_to +
							"assets/sass/blocks/" +
							projectChoice +
							"-npm.scss",
						logall,
						"Copy npm css"
					);

					//add css to file main.
					fs.appendFile(
						copy_to + "assets/sass/main.scss",
						'\r\n@import "blocks/' +
							projectChoice +
							'-npm.scss"; \r\n ',
						function (err) {
							if (err) throw err;
							console.log("Copy npm css");
						}
					);
				} else if (k == "stylish") {
					fs.appendFile(
						copy_to + "lib/block_style.php",
						"\r\n add_filter('acf/section/styles/" +
							projectChoice +
							"', $layout_styles); \r\n ",
						function (err) {
							if (err) throw err;
							console.log("Copy npm scss");
						}
					);
				}
			}
		}
	}
}
function install_js_libs(name, projectChoice) {
	var options = {
		name: name, // your module name
		version: "latest", // expected version [default: 'latest']
		path: ".", // installation path [default: '.']
		forceInstall: false, // force install if set to true (even if already installed, it will do a reinstall) [default: false]
		npmLoad: {
			// npm.load(options, callback): this is the "options" given to npm.load()
			loglevel: "silent", // [default: {loglevel: 'silent'}]
		},
	};
	npmi(options, function (err, result) {
		if (err) {
			if (err.code === npmi.LOAD_ERR) console.log("npm load error");
			else if (err.code === npmi.INSTALL_ERR)
				console.log("npm install error");
			return console.log(err.message);
		}
		copy_npm_assets(projectChoice);
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

function copyFile(source, target, cb, changed) {
	var cbCalled = false;

	var rd = fs.createReadStream(source);
	rd.on("error", function (err) {
		done(err);
	});
	var wr = fs.createWriteStream(target);
	wr.on("error", function (err) {
		done(err);
	});
	wr.on("close", function (ex) {
		done(changed);
	});
	rd.pipe(wr);

	function done(err) {
		if (!cbCalled) {
			cb(err);
			cbCalled = true;
		}
	}
}
