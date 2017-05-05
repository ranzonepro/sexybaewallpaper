--
-- Table structure for table `tbl_admin`
--

CREATE TABLE IF NOT EXISTS `tbl_admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `email` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `tbl_admin`
--

INSERT INTO `tbl_admin` (`id`, `username`, `password`, `email`) VALUES
(1, 'admin', 'adminq1w2', 'viaviwebtech@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_category`
--

CREATE TABLE IF NOT EXISTS `tbl_category` (
  `cid` int(11) NOT NULL AUTO_INCREMENT,
  `category_name` varchar(255) NOT NULL,
  `category_image` varchar(255) NOT NULL,
  `path` varchar(255) NOT NULL,
  PRIMARY KEY (`cid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=32 ;

--
-- Dumping data for table `tbl_category`
--

INSERT INTO `tbl_category` (`cid`, `category_name`, `category_image`, `path`) VALUES
(31, 'Nature', '5072_02.JPG', '');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_gallery`
--

CREATE TABLE IF NOT EXISTS `tbl_gallery` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cat_id` int(11) NOT NULL,
  `image_date` date NOT NULL,
  `image` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=157 ;

--
-- Dumping data for table `tbl_gallery`
--

INSERT INTO `tbl_gallery` (`id`, `cat_id`, `image_date`, `image`) VALUES
(155, 31, '2014-12-26', '68649_07.JPG'),
(156, 31, '2014-12-26', '9509_13.JPG');

--
-- Dumping data for table `tbl_settings`
--

INSERT INTO `tbl_settings` (`id`, `app_name`, `app_logo`, `app_email`, `app_website`, `app_description`) VALUES
(2, 'News Application', 'viavi_logo.png', 'info@viaviweb.com', 'http://viaviweb.in', '<p>The content provided in this app is demo are for demonstrative purposes only and are not available for use by buyers.i not owner of that all &nbsp;information we are found on Internet by google</p>\n');