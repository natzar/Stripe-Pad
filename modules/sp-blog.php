<?php

/**
 * Package Name: Stripe Pad
 * File Description: Blog Model ()
 * 
 * @author Beto Ayesa <beto.phpninja@gmail.com>
 * @version 1.0.0
 * @package StripePad
 * @license GPL3
 * @link https://github.com/natzar/stripe-pad
 * 
 *
 *  This program is free software: you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation, either version 3 of the License, or
 *  (at your option) any later version.
 *
 *  This program is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  This file is part of Stripe Pad.
 *
 *	Stripe Pad is free software: you can redistribute it and/or modify it under the terms of the GNU General Public License as published by the Free Software Foundation, either version 3 of the License, or (at your option) any later version.
 *
 *	Stripe Pad is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU General Public License for more details.
 *
 *	You should have received a copy of the GNU General Public License along with  Stripe Pad. If not, see <https://www.gnu.org/licenses/>.
 */

/**
 *     Blog 
 */
class blogModel extends ModelBase
{
    public function __construct()
    {
        parent::__construct('blog');
    }

	public function getBySlug($slug)
	{
		$q = $this->db->prepare("SELECT * FROM blog WHERE slug = :slug LIMIT 1");
		$q->bindParam(":slug", $slug);
		$q->execute();
		$row = $q->fetch();
		return $this->formatBlogRow($row);
	}
	public function getAll($limit = 20)
	{
		$q = $this->db->prepare("SELECT * FROM blog ORDER BY created DESC LIMIT :limit");
		$q->bindValue(":limit", (int)$limit, PDO::PARAM_INT);
		$q->execute();
		$rows = $q->fetchAll();
		return array_map(function ($row) {
			return $this->formatBlogRow($row);
		}, $rows);
	}
	public function AIgenerateBlogPosts()
	{

        $blogTitles = [
            "Identifying Expiring Domains for Investment Opportunities",
            "Enhancing Digital Marketing Campaigns with Domain Data Insights",
            "Utilizing Domain Data for Competitive Market Analysis",
            "Improving SEO Strategies with Advanced Domain Analytics",
            "Leveraging Domain Information for Targeted Email Marketing",
            "Conducting Comprehensive Web Host and Network Research",
            "Using Domain Data to Track and Analyze Tech Trends",
            "Developing Tailored Content Strategies Based on Domain Analysis",
            "Optimizing Domain Portfolio Management for Domainers",
            "Assisting Legal Teams in Intellectual Property Cases",
            "Supporting Cybersecurity Efforts with Domain Data",
            "Enhancing Academic Research on Internet Trends and Usage",
            "Providing Data-Driven Insights for Domain Appraisal Services",
            "Supporting Government Agencies in Digital Infrastructure Analysis",
            "Enabling Data Journalists to Analyze Web Presence of Organizations",

        ];

        $selects = array("country", "hosting", "lang");

        $o = new Openai();

		foreach ($blogTitles as $title) {

			$r = $o->request($title);
			$r = json_decode($r, true);

			$body = $r['choices'][0]['message']['content'];
			$slug = friendly_slug($title);
			$q = $this->db->prepare("INSERT INTO blog (title,slug,body) VALUES (:t,:s,:b)");
			$q->bindParam(":t", $title);
			$q->bindParam(":b", $body);
			$q->bindParam(":s", $slug);
			$q->execute();

			echo $title . PHP_EOL;
			echo "= ========" . PHP_EOL;
			echo $body;

			echo PHP_EOL . PHP_EOL;
		}
	}

	private function formatBlogRow(?array $row): ?array
	{
		if (!$row) {
			return $row;
		}

		if (isset($row['created'])) {
			$rawCreated = $row['created'];
			$row['created_raw'] = $rawCreated;
			$timestamp = strtotime($rawCreated);
			$formatted = $timestamp !== false ? date('d-m-Y', $timestamp) : $rawCreated;
			$row['created_formatted'] = $formatted;
			$row['created'] = $formatted;
		}

		return $row;
	}
}
