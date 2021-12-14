<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">

<xsl:template match="/">

<xsl:variable name="len" select="0" />

<xsl:for-each select="/gamelist/game">

<xsl:element name="div">
	<xsl:attribute name="value"><xsl:value-of select="@id" /></xsl:attribute>

	<xsl:choose>
		<xsl:when test="@level='1'"><xsl:attribute name="style">color:#407FD4</xsl:attribute></xsl:when>
		<xsl:when test="@level='2'"><xsl:attribute name="style">color:#03A307</xsl:attribute></xsl:when>
		<xsl:when test="@level='3'"><xsl:attribute name="style">color:#FF9000</xsl:attribute></xsl:when>
		<xsl:when test="@level='4'"><xsl:attribute name="style">color:#B651F2</xsl:attribute></xsl:when>
	</xsl:choose>

	<xsl:element name="span">
		<xsl:attribute name="style">font-weight:bold;color:#FF3300</xsl:attribute>
		<xsl:value-of select="substring(@name,1,$len)" />
	</xsl:element>

	<xsl:value-of select="substring(@name,$len+1)" />

	<xsl:element name="input">
		<xsl:attribute name="type">hidden</xsl:attribute>
		<xsl:attribute name="name">unit</xsl:attribute>
		<xsl:attribute name="value"><xsl:value-of select="@unit" /></xsl:attribute>
	</xsl:element>

</xsl:element>

</xsl:for-each>

</xsl:template>

</xsl:stylesheet>