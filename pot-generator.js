#!/usr/bin/env node

const fs = require('fs');
const path = require('path');
const glob = require('glob');

class POTGenerator {
    constructor(options) {
        this.domain = options.domain;
        this.package = options.package;
        this.destFile = options.destFile;
        this.bugReport = options.bugReport;
        this.lastTranslator = options.lastTranslator;
        this.team = options.team;
        this.strings = new Set();
    }

    extractStrings(content) {
        // Basic regex patterns for WordPress translation functions
        const patterns = [
            /__\(\s*['"](.*?)['"],\s*['"]([^'"]*)['"]\s*\)/g,
            /_e\(\s*['"](.*?)['"],\s*['"]([^'"]*)['"]\s*\)/g,
            /_n\(\s*['"](.*?)['"],\s*['"](.*?)['"],\s*.*?,\s*['"]([^'"]*)['"]\s*\)/g,
            /_x\(\s*['"](.*?)['"],\s*['"](.*?)['"],\s*['"]([^'"]*)['"]\s*\)/g,
            /_nx\(\s*['"](.*?)['"],\s*['"](.*?)['"],\s*.*?,\s*['"](.*?)['"],\s*['"]([^'"]*)['"]\s*\)/g,
            /esc_html__\(\s*['"](.*?)['"],\s*['"]([^'"]*)['"]\s*\)/g,
            /esc_attr__\(\s*['"](.*?)['"],\s*['"]([^'"]*)['"]\s*\)/g,
        ];

        patterns.forEach(pattern => {
            let match;
            while ((match = pattern.exec(content)) !== null) {
                if (match[1] && match[1].trim()) {
                    this.strings.add(match[1].trim());
                }
                if (match[2] && match[2].trim() && !match[2].includes(this.domain)) {
                    this.strings.add(match[2].trim());
                }
            }
        });
    }

    processFile(filePath) {
        try {
            const content = fs.readFileSync(filePath, 'utf8');
            this.extractStrings(content);
        } catch (err) {
            console.warn(`Warning: Could not read file ${filePath}:`, err.message);
        }
    }

    generatePOT() {
        const now = new Date();
        const timestamp = now.toISOString().replace(/T/, ' ').replace(/\..+/, '+0000');
        
        let pot = `# ${this.package} POT file
# Copyright (C) ${now.getFullYear()} ${this.package}
# This file is distributed under the same license as the ${this.package} package.
msgid ""
msgstr ""
"Project-Id-Version: ${this.package}\\n"
"Report-Msgid-Bugs-To: ${this.bugReport}\\n"
"POT-Creation-Date: ${timestamp}\\n"
"PO-Revision-Date: YEAR-MO-DA HO:MI+ZONE\\n"
"Last-Translator: ${this.lastTranslator}\\n"
"Language-Team: ${this.team}\\n"
"Language: \\n"
"MIME-Version: 1.0\\n"
"Content-Type: text/plain; charset=UTF-8\\n"
"Content-Transfer-Encoding: 8bit\\n"
"X-Generator: Custom POT Generator\\n"
"X-Poedit-KeywordsList: __;_e;_n;_x;_nx;esc_html__;esc_attr__\\n"
"X-Poedit-Basepath: .\\n"

`;

        // Sort strings alphabetically
        const sortedStrings = Array.from(this.strings).sort();
        
        sortedStrings.forEach(string => {
            // Escape quotes and newlines
            const escapedString = string.replace(/\\/g, '\\\\').replace(/"/g, '\\"').replace(/\n/g, '\\n');
            pot += `msgid "${escapedString}"\n`;
            pot += `msgstr ""\n\n`;
        });

        return pot;
    }

    run() {
        console.log('Generating POT file...');
        
        // Find all PHP files
        const phpFiles = glob.sync('./**/*.php', {
            ignore: [
                './node_modules/**',
                './vendor/**',
                './bower_components/**',
                './dist/**',
                './test-*.php',
                './check-plugin.php',
                './create-*.php',
                './debug-*.php',
                './final-test.php',
                './dynamic-selector-final.php'
            ]
        });

        console.log(`Found ${phpFiles.length} PHP files to process`);

        // Process each file
        phpFiles.forEach(file => {
            this.processFile(file);
        });

        console.log(`Extracted ${this.strings.size} unique translatable strings`);

        // Generate POT content
        const potContent = this.generatePOT();

        // Ensure languages directory exists
        const languagesDir = './languages';
        if (!fs.existsSync(languagesDir)) {
            fs.mkdirSync(languagesDir, { recursive: true });
        }

        // Write POT file
        const potPath = path.join(languagesDir, this.destFile);
        fs.writeFileSync(potPath, potContent);
        
        console.log(`POT file generated: ${potPath}`);
        console.log(`File size: ${(fs.statSync(potPath).size / 1024).toFixed(2)} KB`);
    }
}

// Configuration
const generator = new POTGenerator({
    domain: 'widgetkit-for-elementor',
    package: 'WidgetKit_For_Elementor',
    destFile: 'widgetkit-for-elementor.pot',
    bugReport: 'https://themesgrove.com',
    lastTranslator: 'themesgrove <info@themesgrove.com>',
    team: 'themesgrove <info@themesgrove.com>'
});

generator.run();
