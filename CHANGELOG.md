# Changelog

All notable changes to `companies-house-laravel` will be documented in this file

## 1.1.0 - 2022-09-17

Adding company search and more.

- Added the ability to search for a company using the company name.
- Added a new Company Collection, which when coming back from a search will be populated with SearchResult classes.
- Added the ability to fake the Http Client on the Client itself - for testing utilities.

## 1.0.0 - 2022-09-16

The initial release allows users to:

- Fetch company profile information from companies house
- Validate company numbers against companies house
